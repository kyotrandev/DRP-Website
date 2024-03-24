<?
namespace App\Operations;

class ValidataRecipeDataHolder {
  private static $instance;
  public $validMeal;
  public $validMethod;
  public $validCourse;
  public $validIngredients;

  private function __construct(){
    $this->validMeal = RecipeReadOperation::getCat(1);
    $this->validMethod = RecipeReadOperation::getCat(2);
    $this->validCourse = RecipeReadOperation::getCat(3);
    $this->validIngredients = IngredientReadOperation::getIdAndNameAllObject();
  }


  public static function getInstance() {
    if (!self::$instance) {
        self::$instance = new self();
    }
    return self::$instance;
  }

}