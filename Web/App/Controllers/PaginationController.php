<?php

namespace App\Controllers;
use App\Operations\RecipeReadOperation;
use App\Operations\IngredientReadOperation;
class PaginationController {
    public function getPagingRecipe($page = 1)
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page <= 0) {
            $page = 1;
        }
        $limit = 12;
        $offset = ($page - 1) * $limit;
        $recipes = RecipeReadOperation::getPaging($limit, $offset);
        // Return Recipes as JSON to Ajax request 
        echo json_encode($recipes);
    }

    public function getPagingIngredient($page = 1)
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page <= 0) {
            $page = 1;
        }
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $ingredients = IngredientReadOperation::getPaging($limit, $offset);
        // Return ingredients as JSON to Ajax request 
        echo json_encode($ingredients);
    }
}
?>
