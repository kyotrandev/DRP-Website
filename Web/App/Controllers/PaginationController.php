<?php

namespace App\Controllers;

use App\Operations\RecipeReadOperation;
use App\Operations\IngredientReadOperation;

class PaginationController
{
    private $config = [
        'total' => 0,
        'limit' => 0,
        'full' => true,
        'querystring' => 'page'
    ];

    public function __construct($config = [])
    {
        $condition1 = isset($config['limit']) && $config['limit'] < 0;
        $condition2 = isset($config['total']) && $config['total'] < 0;

        if ($condition1 && $condition2) {
            $e = 'Limit và total page không được nhỏ hơn 0';
            handleException($e);
            die();
        }
        if (!isset($config['querystring'])) {
            $config['querystring'] = 'page';
        }

        $this->config = $config;
    }

    private function getTotalPage()
    {
        $total = $this->config['total'];
        $limit = $this->config['limit'];
        return ceil($total / $limit);
    }

    public function getPagingRecipe($page = 1)
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page <= 0) {
            $page = 1;
        }

        $this->config['$limit'] = 12;
        $offset = ($page - 1) * $this->config['$limit'];
        $recipes = RecipeReadOperation::getPaging($offset, $this->config['$limit']);

        // Return Recipes as JSON to Ajax request
        echo json_encode($recipes);
    }

    public function getPagingIngredient($page = 1)
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if ($page <= 0) {
            $page = 1;
        }

        $this->config['limit'] = 20;
        $offset = ($page - 1) * $this->config['limit'];
        $ingredient = IngredientReadOperation::getPaging($offset, $this->config['limit']);

        $totalIngredient = IngredientReadOperation::getAllObjects();
        // Set Total to count Total Page  
        $this->config['total'] = count($totalIngredient);
        $totalPage = self::getTotalPage();
        // Return ingredients and total page as JSON to Ajax request 
        echo json_encode(['ingredients' => $ingredient, 'totalPage' => $totalPage]);
    }

    
}
