<?php

namespace App\Operations;

use App\Models\IngredientModel;

class IngredientReadOperation extends DatabaseRelatedOperation implements I_ReadOperation {

  const BASE_SQL_QUERY = "SELECT DISTINCT ingredients.id, ingredients.name, ingredient_categories.detail AS category, ingredient_measurement_unit.detail AS unit
                          FROM ingredients 
                          LEFT JOIN ingredient_categories ON ingredients.category = ingredient_categories.id
                          LEFT JOIN ingredient_measurement_unit ON ingredients.measurement_unit = ingredient_measurement_unit.id 
                          LEFT JOIN ingredient_nutritions ON ingredients.id = ingredient_nutritions.ingredient_id ";
  const getSingleObjectById = self::BASE_SQL_QUERY . " WHERE ingredients.id = :id AND ingredients.isActive = 1";
  const getAllObjectsByFieldAndValue = self::BASE_SQL_QUERY . " WHERE :name = :value ingredients.id";
  const getObjectsWithOffset = self::BASE_SQL_QUERY . " limit :limit offset :offset ingredients.id";
  const getObjectWithOffsetByFielAndValue = self::BASE_SQL_QUERY . " WHERE :name = :value ingredients.id limit :limit offset :offset";
  
  public function __construct() {
    parent::__construct();
  }


  /**
   * Retrieves the nutrition information for a specific ingredient.
   *
   * @param int $id The ID of the ingredient.
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is an error executing the SQL statement.
   */
  static public function getNutrition($id) :?array {
    $model = new parent();
    $conn = $model->DB_CONNECTION;

    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }

    /**
     * Prepare the SQL statement to get nutrition information base on 
     * @param self::NUTRITION_COMPONENTS
     */
    $sql = "SELECT nutrition_types.detail AS nutrition_name, ingredient_nutritions.quantity AS nutrition_quantity
            FROM ingredient_nutritions INNER JOIN nutrition_types ON ingredient_nutritions.nutrition_id = nutrition_types.id
            WHERE ingredient_nutritions.ingredient_id = :id";            
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

    try {
      if ($stmt->execute()) {
        $nutritionComponents = $stmt->fetchAll(\PDO::FETCH_KEY_PAIR);
        return $nutritionComponents;
      } else throw new \Exception(parent::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    return null;
  }


  /**
   * Retrieves a single object from the database based on the provided SQL query.
   *
   * @param string $sql The SQL query to execute.
   * @param bool $getNutriOrNot Determines whether to fetch nutrition components or not. Default is true.
   * @param array $params An optional array of parameters to bind to the SQL query.
   * @return IngredientModel The retrieved IngredientModel object.
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is an error executing the SQL query.
   */

  static public function getSingleObject($sql, bool $getNutriOrNot = true, $params = []){
    $model = new parent();
    $conn = $model->DB_CONNECTION;

    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }

    $stmt = $conn->prepare($sql);
    if (!is_null($params)) {
      foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
      }
    }

    if (!$stmt->execute()) 
      throw new \Exception(parent::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($getNutriOrNot == true)
      $row['nutritionComponents'] = self::getNutrition($row['id']);
    return IngredientModel::createObjectByRawArray($row);
  }


  /**
   * Retrieves a single IngredientModel object by its ID.
   *
   * @param int $id The ID of the ingredient to retrieve.
   * @return IngredientModel|null The retrieved IngredientModel object, or null if an error occurred.
   */
  static public function getSingleObjectById(int $id) : ?IngredientModel{
    try {
      return self::getSingleObject(self::getSingleObjectById, true, [':id' => $id]);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return null;
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
      return null;
    }
  }


  /**
   * Retrieves a single IngredientModel object by its ID without including nutritional information.
   *
   * @param int $id The ID of the ingredient to retrieve.
   * @return IngredientModel|null The retrieved IngredientModel object, or null if an error occurs.
   */
  static public function getSingleObjectByIdWithoutNutri(int $id) :?IngredientModel{
    try {
      return self::getSingleObject(self::getSingleObjectById, false, [':id' => $id]);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return null;
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
      return null;
    }
  }


  /**
   * Retrieves multiple objects from the database based on the given SQL query.
   *
   * @param string $sql The SQL query to execute.
   * @param bool $getNutriOrNot Determines whether to fetch nutrition components for each ingredient. Default is true.
   * @param array $params An array of parameters to bind to the SQL query. Default is an empty array.
   * @return array An array of IngredientModel objects representing the retrieved ingredients.
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is an error executing the SQL query.
   */
  static public function getMultipleObject($sql, bool $getNutriOrNot = true, $params = []) {
    $model = new parent();
    $conn = $model->DB_CONNECTION;

    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }

    $stmt = $conn->prepare($sql);
    if (!is_null($params)) 
      foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
      }
    
    if (!$stmt->execute()) 
      throw new \Exception(parent::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    
    $ingredients = [];
    while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      if ($getNutriOrNot == true)
        $row['nutritionComponents'] = self::getNutrition($row['id']);
      $ingredient = IngredientModel::createObjectByRawArray($row);
      $ingredients[] = $ingredient;
    }
    return $ingredients;
  }


  /**
   * Retrieves all objects from the database.
   *
   * @return array|null An array of objects if successful, null otherwise.
   */
  static public function getAllObjects() : ?array {
    try {
      return self::getMultipleObject(self::BASE_SQL_QUERY);
    } catch (\PDOException $exception) {
      handleException($exception);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);

    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }


  /**
   * Retrieves all objects without nutritional information from the database.
   *
   * @return array|null An array of objects without nutritional information, or null if an error occurs.
   */
  static public function getAllObjectsWithoutNutri() : ?array {
    try {
      return self::getMultipleObject(self::BASE_SQL_QUERY, false);
    } catch (\PDOException $exception) {
      handleException($exception);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);

    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }


  /**
   * Retrieves an array of objects with an offset and optional limit.
   *
   * @param int $offset The offset value to start retrieving objects from.
   * @param int|null $limit The maximum number of objects to retrieve. If not provided, defaults to offset + 5.
   * @return array|null An array of objects retrieved with the specified offset and limit, or null if an error occurs.
   */

  public static function getObjectWithOffset(int $offset = 0, int $limit = null) : ?array {
    try{
      if ($limit === null) {
        $limit = $offset + 5;
      }
      return self::getMultipleObject(self::getObjectsWithOffset, true, [':offset' => $offset, ':limit' => $limit]);
    } catch (\PDOException $exception) {
      handleException($exception);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);

    } catch (\Throwable $throwable) {
        handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }


  /**
   * Retrieves an array of objects with offset without including nutritional information.
   *
   * @param int $offset The starting offset for retrieving objects.
   * @param int|null $limit The maximum number of objects to retrieve. If null, defaults to offset + 5.
   * @return array|null An array of objects or null if an exception occurs.
   */
  public static function getObjectWithOffsetWithoutNutri(int $offset = 0, int $limit = null) : ?array {
    try{
      if ($limit === null) {
        $limit = $offset + 5;
      }
      return self::getMultipleObject(self::getObjectsWithOffset, false, [':offset' => $offset, ':limit' => $limit]);
    } catch (\PDOException $exception) {
      handleException($exception);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);

    } catch (\Throwable $throwable) {
        handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }


  /**
   * Retrieves all objects from the database table based on a specified column name and value.
   *
   * @param string $columnName The name of the column to search for.
   * @param mixed $value The value to match in the specified column.
   * @return array|null An array of objects matching the specified column name and value, or null if an error occurred.
   */
  static public function getAllObjectsByFieldAndValue(string $columnName, $value) : ?array {
    try {
      self::getMultipleObject(self::getAllObjectsByFieldAndValue, true, [':name' => $columnName, ':value' => $value]);
    } catch (\PDOException $exception) {
      handleException($exception);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);

    } catch (\Throwable $throwable) {
        handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }


  /**
   * Retrieves all ingredients without nutri info from the database table based on a specified column name and value.
   *
   * @param string $columnName The name of the column to search for.
   * @param mixed $value The value to match in the specified column.
   * @return array|null An array of objects matching the specified column name and value, or null if an error occurred.
   */
  static public function getAllObjectsByFieldAndValueWithoutNutri(string $columnName, $value) : ?array {
    try {
      self::getMultipleObject(self::getAllObjectsByFieldAndValue, false, [':name' => $columnName, ':value' => $value]);
    } catch (\PDOException $exception) {
      handleException($exception);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);

    } catch (\Throwable $throwable) {
        handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }


  /**
   * Retrieves an array of objects with a specified offset, field, and value.
   *
   * @param string $name The name of the field to search for.
   * @param mixed $value The value to search for in the specified field.
   * @param int $offset The starting offset for retrieving the objects. Default is 0.
   * @param int|null $limit The maximum number of objects to retrieve. Default is null, which retrieves 5 objects.
   * @return array|null An array of objects matching the specified field and value, or null if an error occurs.
   */
  static public function getObjectWithOffsetByFielAndValue(string $name, $value, int $offset = 0, int $limit = null) : ?array{
   try{
      if ($limit === null) {
        $limit = $offset + 5;
      }
      return self::getMultipleObject(self::getObjectWithOffsetByFielAndValue, true, 
            [':name' => $name, ':value' => $value, ':offset' => $offset, ':limit' => $limit]);
    } catch (\PDOException $exception) {
      handleException($exception);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }


  /**
   * Retrieves an array of ingredient without nutri info with a specified offset, field, and value.
   *
   * @param string $name The name of the field to search for.
   * @param mixed $value The value to search for in the specified field.
   * @param int $offset The starting offset for retrieving the objects. Default is 0.
   * @param int|null $limit The maximum number of objects to retrieve. Default is null, which retrieves 5 objects.
   * @return array|null An array of objects matching the specified field and value, or null if an error occurs.
   */
  static public function getObjectWithOffsetByFielAndValueWithoutNutri(string $name, $value, int $offset = 0, int $limit = null) : ?array{
    try{
       if ($limit === null) {
         $limit = $offset + 5;
       }
       return self::getMultipleObject(self::getObjectWithOffsetByFielAndValue, false, 
             [':name' => $name, ':value' => $value, ':offset' => $offset, ':limit' => $limit]);
     } catch (\PDOException $exception) {
       handleException($exception);
       echo \App\Views\ViewRender::errorViewRender('500');
     } catch (\Exception $exception) {
       handleException($exception);
     } catch (\Throwable $throwable) {
       handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
     }
     return null;
  }
 

  /**
   * Retrieves the ID and name of all ingredients from the database.
   *
   * @return array|null An array of associative arrays containing the ID and name of each ingredient,
   *                   or null if an error occurred.
   */
  static public function getIdAndNameAllObject() : ?array {
    try {
      $model = new parent();
      $conn = $model->DB_CONNECTION;
      if ($conn == false)
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return null;
    }

    $sql = "select id, name from ingredients";
    $stmt = $conn->prepare($sql);
    try {
      if ($stmt->execute()) {
        $pairs = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $pairs[] = [
            'id' => $row['id'],
            'name' => $row['name']
          ];
        }
        return $pairs;
      } else throw new \Exception(parent::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    return null;
  }


  /**
   * Retrieves the ID and name of all ingredients from the database with pagination.
   *
   * @param int $offset The starting offset for retrieving ingredients.
   * @param int|null $limit The maximum number of ingredients to retrieve. If not provided, defaults to offset + 5.
   */
  static public function getPaging(int $limit, int $offset)  {
    try {
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }


      $stmt = $conn->prepare("select * from ingredients limit :limit offset :offset");
      $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
      $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
      $stmt->execute();

      // Fetch Data
      $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      // Response data JSON
      return json_encode($data);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      return json_encode(["error" => "Database error: " . $PDOException->getMessage()]);
    } catch (\Exception $exception) {
      handleException($exception);
      return json_encode(["error" => "Internal server error: " . $exception->getMessage()]);
    }
  }

  /**
   * Retrieves the IDs of all ingredient categories from the database.
   *
   * @return array|null An array of category IDs, or null if an error occurred.
   */
  static public function getCategoryID(){
    try {
      $dbcon = new parent();
      $conn = $dbcon->DB_CONNECTION;
      if($conn == false){
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      
      $sql = "SELECT id FROM ingredient_categories";
      $stmt = $conn->prepare($sql);
      $stmt->execute();

      $categoryIDs = [];
      $categoryIDs = $stmt->fetchAll(\PDO::FETCH_COLUMN);
      return $categoryIDs;
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return null;
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }


  static public function getNutritionType(){
    try {
      $dbcon = new parent();
      $conn = $dbcon->DB_CONNECTION;
      if($conn == false){
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      
      $sql = "SELECT id FROM nutrition_types";
      $stmt = $conn->prepare($sql);
      $stmt->execute();

      $nutritionType = [];
      $nutritionType = $stmt->fetchAll(\PDO::FETCH_COLUMN);
      return $nutritionType;
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return null;
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }
  
  static public function getMeasurementUnit(){
    try {
      $dbcon = new parent();
      $conn = $dbcon->DB_CONNECTION;
      if($conn == false){
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      
      $sql = "SELECT id FROM ingredient_measuremenet_unit";
      $stmt = $conn->prepare($sql);
      $stmt->execute();

      $measurementUnit = [];
      $measurementUnit = $stmt->fetchAll(\PDO::FETCH_COLUMN);
      return $measurementUnit;
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return null;
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return null;
  }

}
      
