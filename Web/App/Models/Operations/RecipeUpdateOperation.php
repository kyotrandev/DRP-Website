<?

namespace App\Operations;

use App\Controllers\Dialog;

class RecipeUpdateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation
{

  public function __construct()
  {
    parent::__construct();
  }

  static public function notify(string $message): void
  {
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
  static public function validateData(array $data): void
  {
    // Validate data2
    if ($data == null) {
      throw new \InvalidArgumentException("Invalid data provided in " . __METHOD__ . ".");
    }

    $validCategories1 = ['Breakfast', 'Lunch', 'Dinner'];
    $validCategories2 = ['Appetizer', 'Main Dish', 'Side Dish', 'Dessert'];
    $validCategories3 = ['Baked', 'Salad and Salad Dressing', 'Sauce and Condiment', 'Snack', 'Beverage', 'Soup', 'Other'];

    if (
      empty($data['name']) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $data['name']) ||
      empty($data['cooking_time']) ||
      empty($data['preparation_time']) ||
      empty($data['course']) ||
      empty($data['meal']) ||
      empty($data['method']) ||
      empty($data['directions']) ||
      empty($data['description'])
    ) {
      throw new \Exception("Invalid data provided in " . __METHOD__ . ".");
    }
    if ((!in_array($data['course'], $validCategories1)) ||
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
  static public function saveToDatabase(array $data): void
  {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }

    if (isset($data['image_url'])) {
      $sql = "UPDATE recipes set name = :name, description = :description, preparation_time = :preparation_time, 
              cooking_time = :cooking_time, directions = :directions, image_url = :image_url,
              course = :course, meal = :meal, method = :method where id = :id";
      self::query($sql, $conn, \PDO::FETCH_ASSOC, [
        'id' => $data['id'],
        'name' => $data['name'],
        'description' => $data['description'],
        'preparation_time' => $data['preparation_time'],
        'cooking_time' => $data['cooking_time'],
        'image_url' => $data['image_url'],
        'directions' => $data['directions'],
        'course' => $data['course'],
        'meal' => $data['meal'],
        'method' => $data['method']
      ]);
    } else {
      $sql = "UPDATE recipes set name = :name, description = :description, preparation_time = :preparation_time, 
              cooking_time = :cooking_time, directions = :directions, 
              course = :course, meal = :meal, method = :method where id = :id";

      self::query($sql, $conn, \PDO::FETCH_ASSOC, [
        'id' => $data['id'],
        'name' => $data['name'],
        'description' => $data['description'],
        'preparation_time' => $data['preparation_time'],
        'cooking_time' => $data['cooking_time'],
        'directions' => $data['directions'],
        'course' => $data['course'],
        'meal' => $data['meal'],
        'method' => $data['method']
      ]);
    }
  }


  /**
   * Executes the recipe update operation.
   *
   * This method validates the provided data, saves it to the database, and notifies the user about the result.
   *
   * @param array $data The data to update the recipe.
   * @return bool Returns true if the recipe update was successful, false otherwise.
   */
  static public function execute($data): bool {
    try {
      self::validateData($data);
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      handleException($InvalidArgumentException);
      self::notify("Update recipe failed casued by: " . htmlspecialchars($InvalidArgumentException->getMessage()));
      header("Location: /manager/recipe/update?id=" . $data['id']);
    }
    try {
      self::saveToDatabase($data);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      self::notify("Update recipe failed casued by: " . htmlspecialchars($PDOException->getMessage()));
      header("Location: /manager/recipe/update?id=" . $data['id']);
    }

    self::notify("Update recipe successfully! ");
    return true;
  }

  public static function setRecipeActive($data){
    $models = new static;
    $conn = $models->DB_CONNECTION;
    $sql = "UPDATE recipes SET isActive =:isActive WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':isActive', $data['isActive'], \PDO::PARAM_INT);
    $stmt->bindValue(':id', $data['id'], \PDO::PARAM_INT);
    $stmt->execute();
  }
}
