<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\NutritionCalculator;

class NutritionCalculatorController
{
    public function calculateNutrition()
    {
        $recipeId = $_GET('id');

        $DB = new Database();

        $nutritionCalculator = new NutritionCalculator($DB);

        $nutrition = $nutritionCalculator->calculateNutritionForRecipe($recipeId);

        if ($nutrition !== null) {
            return $nutrition;
        } else {
            return null;
        }
    }
}
