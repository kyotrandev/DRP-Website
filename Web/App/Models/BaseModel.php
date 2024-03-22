<?php 
namespace App\Models;
// use autoload from composer
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');


abstract class BaseModel {
    protected $isActive;

    public function __construct() {
        $this->isActive = 1;
    }

    protected function setActive(int $condition = 1){
        $this->isActive = $condition;
    }
    protected function getActive(){
        return $this->isActive;
    }

    static abstract public function createObjectByRawArray($data);
}  