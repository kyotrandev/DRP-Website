<? 
namespace App\Models;
class IngredientNutritionModels extends BaseModel {
  public $calcium;
  public $calories;
  public $carbohydrate;
  public $cholesterol;
  public $fiber;
  public $iron;
  public $fat;
  public $monounsaturated_fat;
  public $polyunsaturated_fat;
  public $saturated_fat;
  public $potassium;
  public $protein;
  public $sodium;
  public $sugar;
  public $vitamin_a;
  public $vitamin_c;

  public static function createObjectByRawArray($data){
    $nutrition = new IngredientNutritionModels;
    $nutrition->calcium = $data['calcium'];
    $nutrition->calories = $data['calories'];
    $nutrition->carbohydrate = $data['carbohydrate'];
    $nutrition->cholesterol = $data['cholesterol'];
    $nutrition->fiber = $data['fiber'];
    $nutrition->iron = $data['iron'];
    $nutrition->fat = $data['fat'];
    $nutrition->monounsaturated_fat = $data['monounsaturated_fat'];
    $nutrition->polyunsaturated_fat = $data['polyunsaturated_fat'];
    $nutrition->saturated_fat = $data['saturated_fat'];
    $nutrition->potassium = $data['potassium'];
    $nutrition->protein = $data['protein'];
    $nutrition->sodium = $data['sodium'];
    $nutrition->sugar = $data['sugar'];
    $nutrition->vitamin_a = $data['vitamin_a'];
    $nutrition->vitamin_c = $data['vitamin_c'];
  }
}