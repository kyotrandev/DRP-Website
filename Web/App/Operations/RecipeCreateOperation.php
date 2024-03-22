<?
namespace App\Operations;
use App\Utils\Dialog;

class RecipeCreateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation
{
  public function __construct() {
    parent::__construct();
  }

  static public function notify(string $message) : void {
    Dialog::show($message);
  }


  /**
   * Validates the recipe data with specific rules.
   *
   * @param array $data The recipe data to be validated.
   * @return void
   * @throws \InvalidArgumentException If the data is invalid.
   * @throws \Exception If the data is missing or does not meet the validation rules.
   */
  static public function validateData(array $data) : void
  {
    // Validate data
    if ($data == null) {
      throw new \InvalidArgumentException("Invalid data provided in " . __METHOD__ . ".");
    }

    $validCategories1 = [1, 2, 3];
    $validCategories2 = [1, 2, 3, 4];
    $validCategories3 = [1, 2, 3, 4, 5, 6, 7];

    if (
      empty($data['name']) || 
      !preg_match('/^[a-zA-Z0-9\s.,()]+$/', $data['name']) ||
      empty($data['cooking_time']) ||
      empty($data['preparation_time']) ||
      empty($data['course']) ||
      empty($data['meal']) ||
      empty($data['directions']) ||
      empty($data['description']) ||
      empty($data['method']) ||
      empty($data['ingredientComponents'])) {
      throw new \Exception("Invalid data provided in " . __METHOD__ . ".");
    }
    if(  (!in_array($data['course'], $validCategories1)) ||
      (!in_array($data['meal'], $validCategories2)) ||
      (!in_array($data['method'], $validCategories3))
    ) {
      throw new \Exception("Invalid data provided in " . __METHOD__ . ".");
    }
  }


  /**
   * Saves the recipe data to the database.
   *
   * @param array $data The recipe data to be saved.
   * @return void
   * @throws \PDOException If there is an error connecting to the database.
   */
  static public function saveToDatabase(array $data) : void {
    $model = new static();
    $conn = $model->DB_CONNECTION;

    // check the connection is okey? 
    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }

    $conn->beginTransaction();
    try{
      // Prepare the SQL query for the recipes table
      $sql = "INSERT INTO recipes (user_id , name, description, isActive, image_url, preparation_time, 
                cooking_time, directions, course, meal, method) 
              values (:name, :description, 1, :image_url, :preparation_time, 
                :cooking_time, :directions, :course, :meal, :method);";
      
      $params = [
        'user_id' => $_SESSION['userId'],
        'name' => $data['name'],
        'description' => $data['description'],
        'image_url' => $data['image_url'] ?? "",
        'preparation_time' => $data['preparation_time'],
        'cooking_time' => $data['cooking_time'],
        'directions' => $data['directions'],
        'course' => $data['course'],
        'meal' => $data['meal'],
        'method' => $data['method']
      ];
      self::query($sql, $conn, \PDO::FETCH_ASSOC, $params);


      // Prepare the SQL query for the ingredient_recipe table
      $recipeId = $conn->lastInsertId();

      $sql2 = "INSERT INTO ingredient_recipe (recipe_id, ingredient_id, quantity, measurement_unit) VALUES ";
      $values = [];
      foreach ($data['ingredientComponents'] as $component) {
        $values[] = "($recipeId, {$component['ingredient_id']}, {$component['quantity']}, '{$component['unit']}')";
      }


    $sql2 .= implode(',', $values);
    // execute the query to insert the ingredient_recipe data
    $conn->exec($sql2);
    $conn->commit();
  
    } catch (\PDOException $PDOException) {
      $conn->rollBack();
      throw $PDOException;
    }
  } 

  
  /**
   * Executes the recipe creation operation.
   *
   * @param array $data The data required for creating the recipe.
   * @return bool Returns true if the recipe is created successfully, false otherwise.
   */
  static public function execute(array $data) : bool {
    try {
      self::validateData($data);
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      handleException($InvalidArgumentException);
      self::notify("Add recipe failed caused by: " . $InvalidArgumentException->getMessage());
      return false;
    }
    try {
      self::saveToDatabase($data);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      self::notify("Add recipe failed caused by: " . $PDOException->getMessage());
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
      self::notify("Add recipe failed caused by: " . $throwable->getMessage());
    }
    self::notify("Add recipe successfully! ");
    return true;
  }
}
