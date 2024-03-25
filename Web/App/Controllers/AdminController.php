<?php

namespace App\Controllers;

use App\Operations\IngredientReadOperation;
use App\Operations\IngredientUpdateOperation;
use App\Operations\UserOperation;
use App\Operations\RecipeReadOperation;
use App\Operations\RecipeUpdateOperation;
use App\Operations\UploadImageOperation;
use App\Operations\ValidateIngredientDataHolder;

class AdminController extends BaseController
{
    public function index()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }
        return $this->loadView('admin.index');
    }

    // User
    public function userManager()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }

        if (isset($_GET['id'])) {
            $users = UserOperation::getUserById($_GET['id']);
        } else if (isset($_GET['username'])) {
            $users = UserOperation::getUserByUsername($_GET['username']);
        } else if (isset($_GET['email'])) {
            $users = UserOperation::getUserByEmail($_GET['email']);
        } else {
            $users = UserOperation::getAllUser();
        }

        return $this->loadView('admin.user', ['users' => $users]);
    }

    public function userManagerUpdateUI()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }
        $users = UserOperation::getUserById($_GET['id']);
        return $this->loadView('admin.userUpdate', ['user' => $users]);
    }

    public function userManagerUpdate()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }
        $data = $_POST;
        UserOperation::update($data);
        header("Location: /manager/user");
    }

    public function userManagerAdd()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }
        $data = $_POST;

        if (UserOperation::checkEmail($data['email'])) {
            echo '<script>
            alert("Email already exist!");
            window.location.href = "/manager/user";
            </script>';
        } else if (UserOperation::checkUserName($data['username'])) {
            echo '<script>
            alert("Username Already Existed");
            window.location.href = "/manager/user";
            </script>';
        } else if (UserOperation::addUser($data)) {
            echo '<script>
                alert("Register Success!");
                window.location.href = "/manager/user";
            </script>';
            exit();
        } else {
            echo '<script>
                alert("Register Fail!, Please try again!");
                window.location.href = "/manager/user";
            </script>';
            exit();
        }

        header("Location: /manager/user");
    }

    public function setUserLevel()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
            $data = $_POST;
            UserOperation::setLevel($data);
            header("Location: /manager/user");
        }
    }

    private function isAdmin()
    {
        return isset($_SESSION['level']) && $_SESSION['level'] == 1;
    }

    /*
        Quản lý recipe
    */
    public function recipeManager()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }
        $recipes = null;
        if (isset($_GET['id'])) {
            $recipes = RecipeReadOperation::getSingleObjectById($_GET['id'], true);
        } else if (isset($_GET['name'])) {
            $recipes = RecipeReadOperation::getAllObjectsByFieldAndValue('recips.name', $_GET['name'], true);
        } else if (isset($_GET['course'])) {
            $recipes = RecipeReadOperation::getAllObjectsByFieldAndValue('recipe_course_categories.id', $_GET['course'], true);
        } else if (isset($_GET['meal'])) {
            $recipes = RecipeReadOperation::getAllObjectsByFieldAndValue('recipe_meal_categories', $_GET['meal'], true);
        } else if (isset($_GET['method'])) {
            $recipes = RecipeReadOperation::getAllObjectsByFieldAndValue('recipe_method_categories', $_GET['method'], true);
        } else $recipes = RecipeReadOperation::getAllObjects(true);

        return $this->loadView('admin.recipe', ['recipes' => $recipes]);
    }

    public function setRecipeActive()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }

        $data = $_POST; 
        RecipeUpdateOperation::setRecipeActive($data);

        header("Location: /manager/recipe");
    }

    public function recipeManagerUpdateUI()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }

        $recipe = RecipeReadOperation::getSingleObjectById($_GET['id'], true);
        return $this->loadView('admin.recipeUpdate', ['recipe' => $recipe]);
    }

    public function recipeManagerUpdate()
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }
        $data = $_POST;

        if ($_FILES['file']['name'] != null){
            $data['image_url'] = UploadImageOperation::process();
        }
        if (RecipeUpdateOperation::execute($data)) {
            echo '<script>
            alert("Update recipes succesful!");
            window.location.href = "/manager/recipe";
            </script>';
        }
    }

    /*
        Quản lý ingredient
    */
    public function ingredientManager()
    {

        var_dump($_GET);
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $ingredients = IngredientReadOperation::getSingleObjectByIdWithoutNutri($_GET['id'], true);
        } else if (isset($_GET['name']) && !empty($_GET['name'])) {
            $ingredients = IngredientReadOperation::getObjectForSearchingWithoutNutri('ingredients.name', $_GET['name'], true);
            echo '1';
        } else if (isset($_GET['category']) && !empty($_GET['category'])) {
            $ingredients = IngredientReadOperation::getAllObjectsByFieldAndValueWithoutNutri('ingredient_categories.id', $_GET['category'], true);
            echo '2';
        } else if (isset($_GET['measurement_desciption']) && !empty($_GET['measurement_desciption'])){
            $ingredients = IngredientReadOperation::getAllObjectsByFieldAndValueWithoutNutri('ingredient_measurement_unit.id', $_GET['measurement_desciption'], true);
            echo '3';
        }
        if ($ingredients == null)
            $ingredients = IngredientReadOperation::getAllObjects(true);

        
        return $this->loadView('admin.ingredient', ['ingredients' => $ingredients]);
    }

    public function setIngredientActive()
    {
        $data = $_POST;
        IngredientUpdateOperation::setIngredientActive($data); 
    }

    public function ingredientManagerUpdateUI() 
    {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }

        $ingredientOpt = ValidateIngredientDataHolder::getInstance();
        $data = $_GET;
        $ingredient = IngredientReadOperation::getSingleObjectById($data['id'], true);

        return $this->loadView('admin.ingredientUpdate', ['ingredient' => $ingredient, 'opts' => $ingredientOpt]);
    }

    public function ingredientManagerUpdate() {
        if (!$this->isAdmin()) {
            return parent::loadError('404');
        }
        $data = $_POST;
        IngredientUpdateOperation::execute($data);
    }
}
