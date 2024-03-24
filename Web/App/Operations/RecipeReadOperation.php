<?

namespace App\Operations;

use App\Models\RecipeModel;

class RecipeReadOperation extends DatabaseRelatedOperation implements I_ReadOperation {

  const BASE_SQL_QUERY = "SELECT DISTINCT 
                            `user_id`, `recipe_id`, `isActive`, `name`, `preparation_time`, `cooking_time`, 
                            `recipe_meal_categories`.`type_name` AS `meal`, 
                            `recipe_method_categories`.`method_name` AS `method`, 
                            `recipe_course_categories`.`type_name` AS `course`,  
                            `image_url`, `directions` AS `direction`, `description`, `timestamp` 
                          FROM `recipes` 
                          LEFT JOIN `recipe_meal_categories` ON `recipes`.`meal` = `recipe_meal_categories`.`id`
                          LEFT JOIN `recipe_method_categories` ON `recipes`.`method` = `recipe_method_categories`.`id`
                          LEFT JOIN `recipe_course_categories` ON `recipes`.`course` = `recipe_course_categories`.`id`";
  const getIngredientDetailsByRecipeId = "SELECT 
                                            `ingredients`.`id`, `ingredients`.`name` AS `ingredientName`, 
                                            `quantity`, `ingredient_measurement_unit`.`detail` AS `unit` 
                                          FROM `recipe_ingredient` 
                                          LEFT JOIN `ingredients` ON `recipe_ingredient`.`ingredient_id` = `ingredients`.`id`
                                          LEFT JOIN `ingredient_measurement_unit` ON `ingredients`.`measurement_unit` = `ingredient_measurement_unit`.`id`
                                          WHERE `recipe_ingredient`.`recipe_id` = :id";

  const getSingleObjectById = self::BASE_SQL_QUERY . " WHERE recipes.recipe_id = :id AND recipes.isActive = 1";
  const getSingleObjectByIdIgnoreActiveMode = self::BASE_SQL_QUERY . " WHERE recipes.recipe_id = :id";
  const getAllObjectsByFieldAndValue = self::BASE_SQL_QUERY . " WHERE :name = :value AND recipes.isActive = 1";
  const getAllObjectsByFieldAndValueIgnoreActiveMode = self::BASE_SQL_QUERY . " WHERE :name = :value";
  const getObjectsWithOffset = self::BASE_SQL_QUERY . "WHERE recipes.isActive = 1 limit :limit offset :offset";
  const getObjectsWithOffsetIgnoreActiveMode = self::BASE_SQL_QUERY . " limit :limit offset :offset";
  const getObjectWithOffsetByFielAndValue = self::BASE_SQL_QUERY . " WHERE :name = :value AND recipes.isActive = 1 limit :limit offset :offset";
  const getObjectWithOffsetByFielAndValueIgnoreActiveMode = self::BASE_SQL_QUERY . " WHERE :name = :value limit :limit offset :offset";


  /**
   * Retrieves the ingredients of a recipe based on the recipe ID.
   *
   * @param int $id The ID of the recipe.
   * @return array|null An array of ingredients or null if no ingredients found.
   */
  static public function getIngredients($id) :?array {
    $sql = self::getIngredientDetailsByRecipeId;
    return self::query($sql,1, ['id' => $id]);
  }

  static protected function getSingleObject($sql, bool $getIngreOrNot = true, $params = [])  : null|RecipeModel{ 
    $Recipe = self::querySingle($sql, 4, $params, "RecipeModel");
    if ($getIngreOrNot == true){
      if (!is_object($Recipe)) {
        return null;
      }
      $Recipe->setIngredientComponents(self::getIngredients($Recipe->getId()));
    }
    return $Recipe;
  }

  /**
   * Retrieves a single RecipeModel object by its ID.
   *
   * @param int $id The ID of the ingredient to retrieve.
   * @return RecipeModel|null The retrieved RecipeModel object, or null if an error occurred.
   */
  static public function getSingleObjectById(int $id, bool $ignoreActiveStatus = false) : ?RecipeModel{
    try {
      $sql = ($ignoreActiveStatus) ? self::getSingleObjectByIdIgnoreActiveMode : self::getSingleObjectById;
      return self::getSingleObject($sql, true, [':id' => $id]);
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

  /**
   * Retrieves all ingredients without nutri info from the database table based on a specified column name and value.
   *
   * @param string $columnName The name of the column to search for.
   * @param mixed $value The value to match in the specified column.
   * @return array|null An array of objects matching the specified column name and value, or null if an error occurred.
   */
  static public function getAllObjectsByFieldAndValueWithoutNutri(string $columnName, $value, bool $ignoreActiveStatus = false) : ?array {
    try {
      $sql = ($ignoreActiveStatus) ? self::getAllObjectsByFieldAndValueIgnoreActiveMode : self::getAllObjectsByFieldAndValue;
      return self::getMultipleObject($sql, false, [':name' => $columnName, ':value' => $value]);
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

  static protected function getMultipleObject($sql, bool $getIngreOrNot = true, $params = []) : ?array{
    $recipes = self::query($sql, 4, $params, "RecipeModel");
    foreach ($recipes as $recipe) {
      if ($getIngreOrNot == true){
        $recipe->setIngredientComponents(self::getIngredients($recipe->getId()));
      }
    }
    return $recipes;
  }


  /**
   * Retrieves all recipe recipes from the database.
   *
   * @return array|null An array of RecipeModel objects representing the recipes retrieved from the database.
   *
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is any other exception thrown during the execution of the method.
   */
  static public function getAllObjects(bool $ignoreActiveStatus = false): ?array {
    try { 
      $sql = ($ignoreActiveStatus) ? self::BASE_SQL_QUERY : self::BASE_SQL_QUERY . " WHERE recipes.isActive = 1";

      return self::getMultipleObject($sql);

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
  
  static public function getAllObjectsWithoutIngre(bool $ignoreActiveStatus = false): ?array {
   try {

     $sql = self::BASE_SQL_QUERY . ($ignoreActiveStatus) ? "" : " WHERE recipes.isActive = 1";

     return self::getMultipleObject($sql, false);

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
  public static function getObjectWithOffset(int $offset = 0, int $limit = null, bool $ignoreActiveStatus = false) : ?array {
    try{
      if ($limit === null) {
        $limit = $offset + 5;
      }
      $sql = ($ignoreActiveStatus) ? self::getObjectsWithOffsetIgnoreActiveMode : self::getObjectsWithOffset;
      return self::getMultipleObject($sql, true, [':offset' => $offset, ':limit' => $limit]);
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
  public static function getObjectWithOffsetWithoutIngre(int $offset = 0, int $limit = null, bool $ignoreActiveStatus = false) : ?array {
    try{
      if ($limit === null) {
        $limit = $offset + 5;
      }
      $sql = ($ignoreActiveStatus) ? self::getObjectsWithOffsetIgnoreActiveMode : self::getObjectsWithOffset;
      return self::getMultipleObject($sql, false, [':offset' => $offset, ':limit' => $limit]);
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
  static public function getAllObjectsByFieldAndValue(string $columnName, $value, bool $ignoreActiveStatus = false) : ?array {
    try {
      $sql = ($ignoreActiveStatus) ? self::getAllObjectsByFieldAndValueIgnoreActiveMode : self::getAllObjectsByFieldAndValue;
      return self::getMultipleObject($sql, true, [':name' => $columnName, ':value' => $value]);
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
  static public function getObjectWithOffsetByFielAndValue(string $name, $value, int $offset = 0, int $limit = null, bool $ignoreActiveStatus= false) : ?array{
    try{
      if ($limit === null) {
        $limit = $offset + 5;
      }
      $sql = ($ignoreActiveStatus) ? self::getObjectWithOffsetByFielAndValueIgnoreActiveMode : self::getObjectWithOffsetByFielAndValue;

      return self::getMultipleObject($sql, true, [':name' => $name, ':value' => $value, ':offset' => $offset, ':limit' => $limit]);

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
   * Retrieves the ID and name of all ingredients from the database with pagination.
   *
   * @param int $offset The starting offset for retrieving ingredients.
   * @param int|null $limit The maximum number of ingredients to retrieve. If not provided, defaults to offset + 5.
   */
  static public function getPaging(int $offset, int $limit = null, bool $ignoreActiveStatus = false) { 
    try {
      if($limit === null) {
        $limit = $offset + 10;
      }

      $sql = ($ignoreActiveStatus) ? self::getObjectsWithOffsetIgnoreActiveMode : self::getObjectsWithOffset;

      // Fetch Data
      $data = self::query($sql, 4, [':offset' => $offset, ':limit' => $limit], "RecipeModel");

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


  // /**
  //  * Retrieves a list of recipes from the database based on the given field and value.
  //  *
  //  * @param string $field The name of the field to search for.
  //  * @param mixed $value The value to match against the field.
  //  * @return string The JSON-encoded response containing the retrieved recipes.
  //  * @throws \PDOException If there is an error connecting to the database.
  //  * @throws \Exception If there is an internal server error.
  //  */
  // static public function getRecipeByIngredientId(string $field, $value) : ?array{
  //   try {
  //     $model = new static();
  //     $conn = $model->DB_CONNECTION;
  //     if ($conn == false) {
  //       throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
  //     }
  //     $sql = "select * from recipes where id in (select recipe_id from ingredient_recipe where {$field} = {$value}) and isActive = 1";
  //     $data = self::query($sql,1);
  //     $recipes = [];
  //     foreach ($data as $recipe) {
  //       $recipes[] = RecipeModel::createObjectByRawArray($recipe);
  //     }
  //     return $recipes;
  //   } catch (\PDOException $PDOException) {
  //     handlePDOException($PDOException);
  //     echo \App\Views\ViewRender::errorViewRender('500');
  //   } catch (\Exception $exception) {
  //     handleException($exception);
  //   } catch (\Throwable $throwable) {
  //     handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
  //   }
  //   return null;
  // }

}