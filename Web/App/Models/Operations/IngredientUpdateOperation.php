<?
namespace App\Operations;
use App\Controllers\Dialog;

class  IngredientUpdateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation {

  static public function notify(string $message) : void {
    Dialog::show($message);
  }

  /**
   * Validate the data with specific rules
   *
   * @param array $data The data to be validated
   * @throws \InvalidArgumentException If the data is invalid
   */
  static public function validateData(array $data) : void {
    /**
     * Validate the data with specific rules
     * name: required, only letters and numbers
     * category: required, must be one of the valid categories
     * measurement_description: required, must be one of the valid measurements
     * calcium, calories, carbohydrate, cholesterol, fiber, iron, fat, monounsaturated_fat, polyunsaturated_fat,
     * saturated_fat, potassium, protein, sodium, sugar, vitamin_a, vitamin_c: optional, must be a number
     */
    if($data == null) 
      throw new \InvalidArgumentException(parent::MSG_DATA_ERROR . __METHOD__ . '. ');
    $validCategories = array('EMMP', 'FAO', 'FRU', 'GNBK', 'HRBS', 'MSF', 'OTHR', 'PRP', 'VEGI');
    $validMeasurements = array('tsp', 'cup', 'tbsp', 'g', 'lb', 'can', 'oz', 'unit');

    $requiredFields = ['name', 'category', 'measurement_description'];
    $numericFields = ['calcium', 'calories', 'carbohydrate', 'cholesterol', 'fiber', 'iron', 'fat', 
      'monounsaturated_fat', 'polyunsaturated_fat', 'saturated_fat', 'potassium', 'protein', 'sodium', 'sugar', 'vitamin_a', 'vitamin_c'];

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

    if (!preg_match('/^[a-zA-Z0-9\s.,]+$/', $data['name']) ||
        !in_array($data['category'], $validCategories) ||
        !in_array($data['measurement_description'], $validMeasurements)) {
      throw new \InvalidArgumentException(parent::MSG_DATA_ERROR . __METHOD__ . '. ');
    } 
  }


  /**
   * Save the data to the database
   *
   * @param array $data The data to be saved
   * @throws \PDOException If the data cannot be saved
   */
  static public function saveToDatabase(array $data) : void {
    $model = new static();
    $conn = $model->DB_CONNECTION;

    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }

    
    if (!isset($data['id'])) {
      throw new \InvalidArgumentException("Missing 'id' key in data array.");
    }
    if (!isset($data['name'])) {
      throw new \InvalidArgumentException("Invalid 'id' value in data array.");
    }

    $sql = "UPDATE ingredients SET name = :name, category = :category, measurement_description = :measurement_description,  
            calcium = :calcium, calories = :calories, carbohydrate = :carbohydrate, cholesterol = :cholesterol, 
            fiber = :fiber, iron = :iron, fat = :fat, monounsaturated_fat = :monounsaturated_fat, 
            polyunsaturated_fat = :polyunsaturated_fat, saturated_fat = :saturated_fat, 
            potassium = :potassium, protein = :protein, sodium = :sodium, sugar = :sugar, 
            vitamin_a = :vitamin_a, vitamin_c = :vitamin_c WHERE id = :id";

    self::query($sql, $conn, \PDO::FETCH_ASSOC, [ 
      'id' => $data['id'],
      'name' => $data['name'],
      'category' => $data['category'],
      'measurement_description' => $data['measurement_description'],
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
  }



  /**
   * Execute the operation
   *
   * @param array $data The data to be used in the operation
   * @return bool True if the operation was successful, false otherwise
   */
  static public function execute(array  $data) : bool{
    try {
      self::validateData($data);
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      handleError($InvalidArgumentException->getCode(), $InvalidArgumentException->getMessage(), 
        $InvalidArgumentException->getFile(), $InvalidArgumentException->getLine());

      self::notify("Update ingredient failed casued by: " . htmlspecialchars($InvalidArgumentException->getMessage()));
      return false;
    }
    try {
      self::saveToDatabase($data);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      self::notify("Update ingredient failed casued by: " . htmlspecialchars($PDOException->getMessage()));
      return false;
    }
    self::notify("Ingredient created successfully!");
    return true;
  }

  public static function setIngredientActive($data){
    $models = new static;
    $conn = $models->DB_CONNECTION;
    $sql = "UPDATE ingredients SET isActive =:isActive WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':isActive', $data['isActive'], \PDO::PARAM_INT);
    $stmt->bindValue(':id', $data['id'], \PDO::PARAM_INT);
    $stmt->execute();
  }
}