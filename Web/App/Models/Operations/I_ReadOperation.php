<?
namespace App\Operations;
interface I_ReadOperation { 
  static function getSingleObjectById(int $id) : mixed;
  static function getAllObjects() : mixed; 
  static function getObjectWithOffset(int $offset = 0, int $limit = 5) : mixed;
  static function getAllObjectsByFieldAndValue(string $columnName, $value) : mixed;
  static function getObjectWithOffsetByFielAndValue(string $name, $value, int $offset = 0, int $limit = 5) : mixed;
  static function getPaging(int $limit, int $offset);
}
