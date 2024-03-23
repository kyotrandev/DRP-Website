<?

namespace App\Operations;

use App\Utils\Dialog;

class IngredientCreateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation 
{ 
  const MSG_UNABLE_TO_VALIDATE_DATA = "Error: something went wrong during validate data - ";


  public function __construct() {
    parent::__construct();
  }


  static public function notify(string $message): void {
    Dialog::show($message);
  }


  /**
   * Validates the ingredient data with specific rules.
   *
   * @param array $data The ingredient data to be validated.
   * @return void
   * @throws \InvalidArgumentException If the data is invalid.
   */
  static public function validateData(array $data): void  {

    /**
     * Validates the ingredient data and retrieves the valid categories, measurements, and nutrition.
     *
     * @param ValidateIngredientDataHolder $validateData The instance of ValidateIngredientDataHolder.
     * @param array $requiredFields The required fields for the ingredient.
     */
    $validateData = new ValidateIngredientDataHolder();
    $validCategories = $validateData->validCategories;
    $validMeasurements = $validateData->validMeasurements;
    $requiredFields = ['name', 'category', 'measurement_unit', 'nutritionComponents'];


    if ($data == null)
      throw new \InvalidArgumentException(parent::MSG_DATA_ERROR . __METHOD__ . '. 1');

    if ($validCategories == null || $validMeasurements == null)
      throw new \PDOException(self::MSG_UNABLE_TO_VALIDATE_DATA . __METHOD__ . ". 1");

    
    // Check if the data is valid
    if (
      !preg_match('/^[a-zA-Z0-9\s.,]+$/', $data['name']) ||
      !in_array($data['category'], array_column($validCategories, 'id')) ||
      !in_array($data['measurement_unit'], array_column($validMeasurements, 'id'))
    ) {
      throw new \InvalidArgumentException(parent::MSG_DATA_ERROR . __METHOD__ . '. 2');
    }


    // Check if the required fields are empty
    foreach ($requiredFields as $field) {
      if (empty($data[$field])) {
        throw new \InvalidArgumentException(parent::MSG_DATA_ERROR . __METHOD__ . '. 3');
      }
    }
    echo "<pre>";
    echo var_dump($data);
    echo "</pre><br>Hello World!<br>";
    // return $data;
  }


  /**
   * Save the data to the database
   *
   * @param array $data The data to be saved
   * @throws \PDOException If the data cannot be saved
   */
  static public function saveToDatabase(array $data) : void {
    $model = new parent();
    $conn = $model->DB_CONNECTION;
    
    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
 
    try {
      $conn->beginTransaction();
      $insertIngredientSql = "INSERT INTO ingredients (`name`, `category`, `measurement_unit`)
                              VALUES (:name, :category, :measurement_unit)";

      $ingredientStmt = $conn->prepare($insertIngredientSql);
      $ingredientStmt->execute([
        'name' => $data['name'],
        'category' => $data['category'],
        'measurement_unit' => $data['measurement_unit']
      ]);
            
      $ingredientId = $conn->lastInsertId();

      $insertNutritionSql = "INSERT INTO `ingredient_nutritions`(`ingredient_id`, `nutrition_id`, `quantity`) VALUES ";

      foreach ($data['nutritionComponents'] as $nutritionType => $nutritionValue) {
        if ($nutritionValue != null && $nutritionValue != 0) {
          $insertNutritionSql .= "({$ingredientId}, '{$nutritionType}', {$nutritionValue}),";
        }
      }
      $insertNutritionSql = rtrim($insertNutritionSql, ',');



      // execute the query to insert the ingredient_recipe data
    if ($conn->exec($insertNutritionSql) === false) 
      throw new \Exception("Error: Unable to insert ingredient nutrition data - " . __METHOD__);
      $conn->commit();
    } catch (\PDOException $PDOException) {
      $conn->rollBack();
      throw $PDOException;
    }
  }

  /**
   * Execute the operation
   *
   * @param array $data The data to be executed
   * @return bool True if the operation is successful, false otherwise
   */
  static public function execute(array $data): bool {
    /**
     * Validate the data before saving to the database
     */
    try {
      self::validateData($data);
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      handleException($InvalidArgumentException);
      self::notify("Add ingredient failed casued by: " . $InvalidArgumentException->getMessage());
      return false;
    }

    /**
     * Saving datab to database process
     */
    try {
      self::saveToDatabase($data);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      self::notify("Add ingredient failed casued by: " . $PDOException->getMessage());
      return false;
    } catch (\Exception $Exception) {
      handleException($Exception);
      self::notify("Add ingredient failed casued by: " . $Exception->getMessage());
      return false;
    } catch (\Throwable $Throwable) {
      handleError($Throwable->getCode(), $Throwable->getMessage(), $Throwable->getFile(), $Throwable->getLine());
      self::notify("Add ingredient failed casued by: " . $Throwable->getMessage());
      return false;
    }
    self::notify("Ingredient created successfully!");
    return true;
  }
}
