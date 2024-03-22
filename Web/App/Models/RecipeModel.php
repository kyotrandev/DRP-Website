<?php 
namespace App\Models;
// use autoload from composer
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');

class RecipeModel extends BaseModel {
    const TABLE = 'Recipes';
    private $id;
    private $name;
    private $description;
    private $image_url;
    private $preparation_time;
    private $cooking_time;
    private $direction;
    private $meal_type_1;
    private $meal_type_2;
    private $meal_type_3;
    private $timestamp;
    private $ingredientComponets = [];

    public function __construct($id = null, $name = null, $description = null, $image_url = null, 
            $preparation_time = null, $cooking_time = null, $direction = null, $meal_type_1 = null, 
            $meal_type_2 = null, $meal_type_3 = null, $timestamp = null, $ingredientComponets = null) {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image_url = $image_url;
        $this->preparation_time = $preparation_time;
        $this->cooking_time = $cooking_time;
        $this->direction = $direction;
        $this->meal_type_1 = $meal_type_1;
        $this->meal_type_2 = $meal_type_2;
        $this->meal_type_3 = $meal_type_3;
        $this->timestamp = $timestamp;
        $this->ingredientComponets = $ingredientComponets; 
    }

    // get and set 
    public function getId() { return $this->id;  }
    public function setId($id) { $this->id = $id; }
    public function getActive() { return $this->isActive; }
    public function setActive($condition = 1) { $this->isActive = $condition; }
    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }
    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }
    public function getImgUrl() { return $this->image_url; }
    public function setImgUrl($image_url) { $this->image_url = $image_url; }
    public function getPreparationTime() { return $this->preparation_time; }
    public function setPreparationTime($preparation_time) { 
        $this->preparation_time = $preparation_time; 
    }
    public function getCookingTime() { return $this->cooking_time; }
    public function setCookingTime($cooking_time) { 
        $this->cooking_time = $cooking_time; 
    }
    public function getDirection() { return $this->direction; }
    public function setDirection($direction) { $this->direction = $direction; }
    public function getMealType1() { return $this->meal_type_1; }
    public function setMealType1($meal_type_1) { $this->meal_type_1 = $meal_type_1; }
    public function getMealType2() { return $this->meal_type_2; }
    public function setMealType2($meal_type_2) { $this->meal_type_2 = $meal_type_2; }
    public function getMealType3() { return $this->meal_type_3; }
    public function setMealType3($meal_type_3) { $this->meal_type_3 = $meal_type_3; }
    public function getTimestamp() { return $this->timestamp; }
    public function setTimestamp($timestamp) { $this->timestamp = $timestamp; }
    public function getIngredientComponets() { return $this->ingredientComponets; }
    public function setIngredientComponets($ingredientComponets) { 
        $this->ingredientComponets = self::addIngredient($ingredientComponets); 
    }

    public static function addIngredient($data) {
        if(isset($data)){
            $ingredientComponets = [];
            foreach ($data as $ingredient) {
                $ingredientComponets[] = array(
                    'ingredient_name'=> $ingredient['name'],
                    'quantity' => $ingredient['number_of_unit'],
                    'unit' => $ingredient['measurement_description']
                );
            }
        } else {
            $ingredientComponets [] = null;
        }
        return $ingredientComponets;
    }

    public static function createObjectByRawArray($data){
        $object = new self();
        $object->setId($data['id']);
        $object->setActive($data['isActive'] ?? 1);
        $object->setName($data['name']);
        $object->setDescription($data['description'] ?? "Unknown");
        $object->setImgUrl($data['image_url'] ?? null);
        $object->setPreparationTime($data['preparation_time_min'] ?? "Unknown");
        $object->setCookingTime($data['cooking_time_min'] ?? "Unknown");
        $object->setDirection($data['directions'] ?? "Unknown");
        $object->setMealType1($data['meal_type_1'] ?? "Unknown");
        $object->setMealType2($data['meal_type_2'] ?? "Unknown");
        $object->setMealType3($data['meal_type_3'] ?? "Unknown");
        $object->setTimestamp($data['timestamp'] ?? "Unknown");
        if (isset($data['ingredientComponents']))
            $object->setIngredientComponets(($data['ingredientComponents']));
        return $object;
    }
}
