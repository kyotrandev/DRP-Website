<?
namespace App\Operations;
interface I_DeleteOperation {
  static function deleteById($id);
  static function deleteByFieldAndValue(string $fieldName, $value);
}