<?php namespace App\Models;
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
// use autoload from composer
use PDOException;

class UserModel extends BaseModel {
    const CLASSNAME = 'App\\Model\\UserModel';
    const TABLE = 'users';

    protected $id;
    protected $username;
    protected $password;
    protected $first_Name;
    protected $last_Name;
    protected $date_of_birth;
    protected $email;
    protected $gender;
    protected $level;

    //Getter
    public function getId() {
        return $this->id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getFirstName() {
        return $this->first_Name;
    }
    public function getLastName() {
        return $this->last_Name;
    }
    public function getDateOfBirth() {
        return $this->date_of_birth;
    }
    public function getGender(){
        return $this->gender;
    }
    public function getLevel() {
        return $this->level;
    }

    // setter
    public function setId($id) {
        $this->id = $id;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setFirstName($first_name) {
        $this->first_Name = $first_name;
    }
    public function setLastName($last_name) {
        $this->last_Name = $last_name;
    }
    public function setDateOfBirth($date_of_birth) {
        $this->date_of_birth = $date_of_birth;
    }
    public function setGender($gender) {
        $this->gender = $gender;
    } 
    static public function createObjectByRawArray($data){
        $object = new self();
        $object->setId($data['id']);
        $object->setActive($data['isActive']) ?? 1;
        $object->setUsername($data['username']);
        $object->setPassword($data['password']);
        $object->setFirstName($data['first_name']);
        $object->setLastName($data['last_name']);
        $object->setDateOfBirth($data['date_of_birth'] ?? "");
        $object->setGender($data['gender'] ?? "");
        $object->setEmail($data['email'] ?? "");
        return $object;
    }
}