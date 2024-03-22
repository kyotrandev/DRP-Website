<?php
namespace App\Models;
use App\Core\Database;
class NutritionCalculator
{
  private $DB;
  public function __construct(Database $DB)
  {
    $this->DB = $DB;
  }
  public function calculateNutritionForRecipe($recipeId)
  {
    try {
      $sql = "SELECT ir.ingredient_id, ir.number_of_unit,ir.measurement_description
                FROM ingredient_recipe ir
                WHERE ir.recipe_id = :recipeId";

      $stmt = $this->DB->getConnection()->prepare($sql);
      $stmt->bindParam(':recipeId', $recipeId, \PDO::PARAM_INT);
      $stmt->execute();

      $totalNutrition = array(
        'calcium' => 0,
        'calories' => 0,
        'carbohydrate' => 0,
        'cholesterol' => 0,
        'fiber' => 0,
        'iron' => 0,
        'fat' => 0,
        'monounsaturated_fat' => 0,
        'polyunsaturated_fat' => 0,
        'saturated_fat' => 0,
        'potassium' => 0,
        'protein' => 0,
        'sodium' => 0,
        'sugar' => 0,
        'vitamin_a' => 0,
        'vitamin_c' => 0
      );

      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $sqlIngredient = "SELECT *
                          FROM ingredients
                          WHERE id = :ingredientId";

        $stmtIngredient = $this->DB->getConnection()->prepare($sqlIngredient);
        $stmtIngredient->bindParam(':ingredientId', $row['ingredient_id'], \PDO::PARAM_INT);
        $stmtIngredient->execute();

        $ingredient = $stmtIngredient->fetch(\PDO::FETCH_ASSOC);

        if ($ingredient === false) {
          throw new \Exception("Thành phần không tồn tại");
        }

        

        foreach ($totalNutrition as $key => $value) {
          if ($ingredient[$key] !== null && $row['number_of_unit'] !== null) {
              if ($row['measurement_description'] == 'g') {
                  $totalNutrition[$key] += $ingredient[$key] * $row['number_of_unit'] / 100;         
          }else{ $totalNutrition[$key] += $ingredient[$key] * $row['number_of_unit'];}
          }
        }
      }

      return $totalNutrition;
    } catch (\PDOException $e) {
      echo "Lỗi truy vấn: " . $e->getMessage();
    } catch (\Exception $e) {
      echo "Lỗi: " . $e->getMessage();
    }

    return null;
  }
}
