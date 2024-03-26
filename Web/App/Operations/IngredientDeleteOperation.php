<? 
namespace App\Operations;
class IngredientDeleteOperation extends DeleteOperation {
  
  static public function deleteById($id) : bool  {
    try {
      $model = new IngredientDeleteOperation();
      $conn = $model->DB_CONNECTION;
      
      if ($conn == false) {
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }

      $sql = "DELETE FROM ingredients WHERE id = :id";

      $model->querySingle($sql, 1, [':id' => $id]);
      return true;

    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      parent::notify(false, "Delete ingredient failed caused by: Unknown errors! We are sorry for the inconvenience!");
    } catch (\Throwable $Throwable) {
      handleError($Throwable->getCode(), $Throwable->getMessage(), $Throwable->getFile(), $Throwable->getLine());
      parent::notify(false, "Delete ingredient failed caused by: Unknown errors! We are sorry for the inconvenience!");      
    }
    return false;
  }

  static public function deleteByFieldAndValue(string $fieldName, $value) : bool {
    try {
      $model = new IngredientDeleteOperation();
      $conn = $model->DB_CONNECTION;
      
      if ($conn == false) {
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }

      $sql = "DELETE FROM ingredients WHERE $fieldName = :value";
      $model->query($sql, 1, [':value' => $value]);
      parent::notify(true, "Ingredient deleted successfully!");
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      parent::notify(false, "Delete ingredient failed caused by: Unknown errors! We are sorry for the inconvenience!");
    } catch (\Throwable $Throwable) {
      handleError($Throwable->getCode(), $Throwable->getMessage(), $Throwable->getFile(), $Throwable->getLine());
      parent::notify(false, "Delete ingredient failed caused by: Unknown errors! We are sorry for the inconvenience!");      
    }
    return false;
  }
}