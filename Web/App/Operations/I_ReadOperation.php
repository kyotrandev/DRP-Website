<?
namespace App\Operations;
interface I_ReadOperation { 
  static function getSingleObjectById($id, bool $ignoreActiveStatus = false) : mixed;
  static function getAllObjects(bool $ignoreActiveStatus = false) : mixed; 
  static function getObjectWithOffset(int $offset = 0, int $limit = 5, bool $ignoreActiveStatus = false) : mixed;
  static function getAllObjectsByFieldAndValue(string $fieldName, $value, bool $ignoreActiveStatus = false) : mixed;
  static function getObjectWithOffsetByFielAndValue(string $name, $value, int $offset = 0, int $limit = 5, bool $ignoreActiveStatus = false) : mixed;
  static function getPaging(int $limit, int $offset);
}
