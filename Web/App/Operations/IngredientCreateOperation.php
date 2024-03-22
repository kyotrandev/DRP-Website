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
    $validateData = ValidateIngredientDataHolder::getInstance();
    $validCategories = $validateData->validCategories;
    $validMeasurements = $validateData->validMeasurements;
    
    /**
     * Validate the data with specific rules
     * name: required, only letters and numbers
     * category: required, must be one of the valid categories
     * measurement_unit: required, must be one of the valid measurements
     * calcium, calories, carbohydrate, cholesterol, fiber, iron, fat, monounsaturated_fat, polyunsaturated_fat,
     * saturated_fat, potassium, protein, sodium, sugar, vitamin_a, vitamin_c: optional, must be a number
     */

    if ($data == null)
      throw new \InvalidArgumentException(parent::MSG_DATA_ERROR . __METHOD__ . '. ');

    if ($validCategories == null || $validMeasurements == null)
      throw new \PDOException(self::MSG_UNABLE_TO_VALIDATE_DATA . __METHOD__ . ". ");

    $requiredFields = ['name', 'category', 'measurement_unit'];
    $numericFields = [
      'calcium', 'calories', 'carbohydrate', 'cholesterol', 'fiber', 'iron', 'fat',
      'monounsaturated_fat', 'polyunsaturated_fat', 'saturated_fat', 'potassium', 'protein', 'sodium', 'sugar', 'vitamin_a', 'vitamin_c'
    ];

    foreach ($requiredFields as $field) {
      if (empty($data[$field])) {
        throw new \InvalidArgumentException(parent::MSG_DATA_ERROR . __METHOD__ . '. ');
      }
    }

    foreach ($numericFields as $field) {
      if (!empty($data[$field]) && !is_numeric($data[$field])) {
        throw new \InvalidArgumentException(parent::MSG_DATA_ERROR . __METHOD__ . '. ');
      }
    }

    if (
      !preg_match('/^[a-zA-Z0-9\s.,]+$/', $data['name']) ||
      !in_array($data['category'], $validCategories) ||
      !in_array($data['measurement_unit'], $validMeasurements)
    ) {
      throw new \InvalidArgumentException(parent::MSG_DATA_ERROR . __METHOD__ . '. ');
    }
  }


  /**
   * Save the data to the database
   *
   * @param array $data The data to be saved
   * @throws \PDOException If the data cannot be saved
   */
  static public function saveToDatabase(array $data): void {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    try {
      $conn->beginTransaction();
      $insertIngredientSql = "INSERT INTO ingredients (`name`, `category`, `measurement_unit`)
              VALUES (:name, :category, :measurement_unit)";
      self::query($insertIngredientSql, $conn, \PDO::FETCH_ASSOC, [
        'name' => $data['name'],
        'category' => $data['category'],
        'measurement_unit' => $data['measurement_unit']]);
      
      $ingredientId = $conn->lastInsertId();
      $insertNutritionSql = "INSERT INTO ingredient_nutritions (`id`, `calories`, `calcium`, `carbohydrate`, 
                              `cholesterol`, `fiber`, `iron`, `fat`, `monounsaturated_fat`, `polyunsaturated_fat`, 
                              `saturated_fat`, `potassium`, `protein`, `sodium`, `sugar`, `vitamin_a`, `vitamin_c`) 
                            VALUES ({$ingredientId} , :calcium, :calories, :carbohydrate, :cholesterol, 
                              :fiber, :iron, :fat, :monounsaturated_fat, :polyunsaturated_fat, 
                              :saturated_fat, :potassium, :protein, :sodium, :sugar, :vitamin_a, :vitamin_c)";

      /** 
       * Execute the query with the given data
       */
      self::query($insertNutritionSql, $conn, \PDO::FETCH_ASSOC, [
        'calcium' => $data['calcium'] ?? 0,
        'calories' => $data['calories'] ?? 0,
        'carbohydrate' => $data['carbohydrate'] ?? 0,
        'cholesterol' => $data['cholesterol'] ?? 0,
        'fiber' => $data['fiber'] ?? 0,
        'iron' => $data['iron'] ?? 0,
        'fat' => $data['fat'] ?? 0,
        'monounsaturated_fat' => $data['monounsaturated_fat'] ?? 0,
        'polyunsaturated_fat' => $data['polyunsaturated_fat'] ?? 0,
        'saturated_fat' => $data['saturated_fat'] ?? 0,
        'potassium' => $data['potassium'] ?? 0,
        'protein' => $data['protein'] ?? 0,
        'sodium' => $data['sodium'] ?? 0,
        'sugar' => $data['sugar'] ?? 0,
        'vitamin_a' => $data['vitamin_a'] ?? 0,
        'vitamin_c' => $data['vitamin_c'] ?? 0
      ]);
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
    }

    self::notify("Ingredient created successfully!");
    return true;
  }
}
