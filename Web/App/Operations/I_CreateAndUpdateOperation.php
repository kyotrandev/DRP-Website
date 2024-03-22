<? 
namespace App\Operations;

interface I_CreateAndUpdateOperation {
  static public function validateData(array $data) : void;
  static public function saveToDatabase(array $data) : void;
  static public function notify(string $message) : void;
}
