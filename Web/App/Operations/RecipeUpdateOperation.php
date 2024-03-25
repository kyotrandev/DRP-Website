<?

namespace App\Operations;

use App\Utils\Dialog;

class RecipeUpdateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation
{

  static public function notify(bool $success, string $message) {
    $response = [
      'success' => $success,
      'message' => $message,
  ];

  header('Content-Type: application/json');
  // Trả về dữ liệu JSON
  echo json_encode($response);
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


    try {
      if (isset($data['image_url'])) {
        $sql = "UPDATE recipes set name = :name, description = :description, preparation_time = :preparation_time, 
                cooking_time = :cooking_time, directions = :directions, image_url = :image_url,
                course = :course, meal = :meal, method = :method where id = :id";
        self::query($sql, 1, [
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

        self::query($sql,1, [
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
    } catch (\PDOException $PDOException) {
      throw $PDOException;
    }
  }


  /**
   * Execute the operation
   *
   * @param array $data The data to be used in the operation
   * @return bool True if the operation was successful, false otherwise
   */
  static public function execute(array  $data) : void{
    try {
      /**
       * Validate the data before saving to the database
       */
      self::validateData($data);

      /**
       * Saving data to the database process
       */
      self::saveToDatabase($data);

      // If everything goes well, set success to true and provide a success message
      
      self::notify(true, "Recipe updated successfully!");
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      // Handle validation errors
      handleException($InvalidArgumentException);
      self::notify(false, "Update recipe failed caused by: invalid input. Please check your input again!");
    } catch (\PDOException $PDOException) {
      // Handle database errors
      handlePDOException($PDOException);
      self::notify(false, "Update recipe failed caused by: Unknown errors! We are sorry for the inconvenience!");
    } catch (\Exception $Exception) {
      // Handle other exceptions
      handleException($Exception);
      self::notify(false, "Update recipe failed caused by: invalid data!. Please check the data and try again!");
    } catch (\Throwable $Throwable) {
      // Handle other errors
      handleError($Throwable->getCode(), $Throwable->getMessage(), $Throwable->getFile(), $Throwable->getLine());
      self::notify(false, "Update recipe failed caused by an unknown error!. We are sorry for the inconvenience!");      
    }
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
