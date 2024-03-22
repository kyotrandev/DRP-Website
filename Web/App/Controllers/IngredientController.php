<?php 
namespace App\Controllers;
use App\Operations\IngredientReadOperation;
use App\Operations\IngredientCreateOperation;
use App\Operations\IngredientUpdateOperation;

// use autoload from composer
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');

class IngredientController extends BaseController
{
    public function index() {
        $ingredients = IngredientReadOperation::getAllObjects();
        return $this->loadView('ingredient.list_all', $ingredients);
    }
    public function listByCategory() {
        $category = $_GET['category'];
        $ingredients = IngredientReadOperation::getAllObjectsByFieldAndValue('category', $category);
        if(! $ingredients == null) 
            return $this->loadView('ingredient.list_all', $ingredients);
        else
            echo \App\Views\ViewRender::errorViewRender('410');
    }
    public function listByCategoryWithOffset() {
        $category = $_GET['category'];
        $offset = $_GET['offset'];
        $limit = $_GET['limit'];
        $ingredients = IngredientReadOperation::getObjectWithOffsetByFielAndValue('category', $category, $offset, $limit);
        if ($ingredients == null) {
            echo \App\Views\ViewRender::errorViewRender('410');
        }
        else
            return $this->loadView('ingredient.list_all', $ingredients);
    }
    
    public function addUI() {
        return $this->loadView('ingredient.add');
    }
    public function add() {
        $data = $_POST;
        IngredientCreateOperation::execute($data);
        header("Location: /ingredient/add");
    }


    public function findByName(){
        return $this->loadView('ingredient.find_ingredient');
    }

    public function editUI() {
        try {
            $ingredient = IngredientReadOperation::getSingleObjectById(1);
            $data[] = $ingredient; 
            return $this->loadView('ingredient.update', $data);
        } catch (\PDOException $PDOException) {
            handlePDOException($PDOException);
            echo \App\Views\ViewRender::errorViewRender('500');
        } catch (\Exception $exception) {
            handleException($exception);
        } catch (\Throwable $throwable) {
            handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
        }
        echo \App\Views\ViewRender::errorViewRender('404');
        return null;
    }

    public function edit() {
        $data = $_POST;
        IngredientUpdateOperation::execute($data);
        header("Location: /ingredient/edit");
    }

}