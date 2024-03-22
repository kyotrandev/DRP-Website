<?php

namespace App\Operations;

use App\Models\IngredientModel;

class IngredientReadOperation extends DatabaseRelatedOperation implements I_ReadOperation
{
  public function __construct() {
    parent::__construct();
  }


  /**
   * Retrieves a single ingredient object by its ID.
   *
   * @param int $id The ID of the ingredient to retrieve.
   * @return IngredientModel|null The retrieved ingredient object, or null if not found.
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is an error executing the database query.
   */
  static public function getSingleObjectById(int $id) : ?IngredientModel{

    $model = new static;
    $conn = $model->DB_CONNECTION;

    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }

    $sql = "select * from ingredients where id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

    /**
     * Execute the statement and return the value
     */
    try {
      if ($stmt->execute()) {
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return IngredientModel::createObjectByRawArray($row);
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
   * Retrieve all objects from the ingredients table.
   *
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is an error executing the SQL statement.
   *
   * @return array|null An array of IngredientModel objects representing the retrieved ingredients, or null if an error occurred.
   */
  static public function getAllObjects() : ?array {
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false) {
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
    }

    /**
     * Prepare the SQL statement and execute it
     */

    $sql = "select * from ingredients";
    $stmt = $conn->prepare($sql);

    /**
     * Execute the statement and return the value
     */

    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createObjectByRawArray($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
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
   * Retrieve a list of ingredients from the database with pagination.
   *
   * @param int $offset The starting offset for retrieving ingredients.
   * @param int|null $limit The maximum number of ingredients to retrieve. If not provided, defaults to offset + 5.
   * @return array|null An array of IngredientModel objects representing the retrieved ingredients, or null if an error occurs.
   */

  public static function getObjectWithOffset(int $offset = 0, int $limit = null) : ?array {

    if ($limit === null) {
      $limit = $offset + 5;
    }

    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false)
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return null;
    }


    /**
     * Prepare the SQL statement and execute it
     */
    $sql = "select * from ingredients limit :limit offset :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);


    /**
     * Execute the statement and return the value
     */
    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createObjectByRawArray($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
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
   * Retrieves all objects from the database table based on a specific column and value.
   *
   * @param string $columnName The name of the column to search in.
   * @param mixed $value The value to search for in the specified column.
   * @return array|null An array of objects representing the retrieved records, or null if an error occurred.
   */
  static public function getAllObjectsByFieldAndValue(string $columnName, $value) : ?array {
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false)
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return null;
    }


    /**
     * Prepare the SQL statement and execute it
     */
    $sql = "select * from ingredients where {$columnName} like '%{$value}%'";
    $stmt = $conn->prepare($sql);
    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createObjectByRawArray($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
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
   * Retrieves an array of ingredient objects from the database based on the specified field and value.
   *
   * @param string $name The name of the field to search for.
   * @param mixed $value The value to match against the specified field.
   * @param int $offset The offset for pagination. Default is 0.
   * @param int|null $limit The maximum number of results to retrieve. Default is null, which retrieves 5 results.
   * @return array|null An array of ingredient objects if successful, null otherwise.
   */
  static public function getObjectWithOffsetByFielAndValue(string $name, $value, int $offset = 0, int $limit = null) : ?array{
    /** 
     * Make sure the connection to the database is established
     */

    if ($limit === null) {
      $limit = $offset + 5;
    }
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false)
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return null;
    }


    /**
     * Prepare the SQL statement and execute it
     */
    $sql = "select * from ingredients where {$name} = {$value} limit :limit offset :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);



    /**
     * Execute the statement and return the value
     */
    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createObjectByRawArray($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
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
   * Retrieves the ID and name of all ingredients from the database.
   *
   * @return array|null An array of associative arrays containing the ID and name of each ingredient,
   *                   or null if an error occurred.
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is an error executing the SQL query.
   */
  static public function getIdAndNameAllObject() : ?array {
    try {
      $model = new static;
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
}
