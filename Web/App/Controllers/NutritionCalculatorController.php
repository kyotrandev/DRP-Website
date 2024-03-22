<?php

namespace App\Controllers;

use App\Core\Database;
use App\Operations\NutritionCalculator;

class NutritionCalculatorController
{
    public function calculateNutrition()
    {
        $recipeId = $_GET('id');

        $nutrition = NutritionCalculator::calculateNutritionForRecipe($recipeId);

        if ($nutrition !== null) {
            return $nutrition;
        } else {
            return null;
        }
    }
}
