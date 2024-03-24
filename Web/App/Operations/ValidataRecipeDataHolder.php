<?
namespace App\Operations;

class ValidataRecipeDataHolder {
  private static $instance;
  public $validCategories;
  public $validMeasurements;
  public $validNutrition;
  public $validIngredients;

  private function __construct(){
    $this->validCategories = RecipeReadOperation::getCat(1);
    $this->validMeasurements = RecipeReadOperation::getCat(2);
    $this->validNutrition = RecipeReadOperation::getCat(3);
    $this->validIngredients = IngredientReadOperation::getIdAndNameAllObject();
  }


  public static function getInstance() {
    if (!self::$instance) {
        self::$instance = new self();
    }
    return self::$instance;
  }

}