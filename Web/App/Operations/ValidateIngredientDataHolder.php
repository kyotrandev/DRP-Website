<? 
namespace  App\Operations;

class ValidateIngredientDataHolder {
    private static $instance;
    public $validCategories;
    public $validMeasurements;
    public $validNutrition;
    private function __construct() {
        // Khởi tạo giá trị của $validCategories và $validMeasurements ở đây
        $this->validCategories = IngredientReadOperation::getCategoryID();
        $this->validMeasurements = IngredientReadOperation::getMeasurementUnit();
        $this->validNutrition = IngredientReadOperation::getNutritionType();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
