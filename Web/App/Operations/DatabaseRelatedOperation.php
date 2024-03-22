<?
namespace App\Operations;
class DatabaseRelatedOperation {
  const MSG_EXECUTE_PDO_LOG = "Error: Execute the prepare statement failed - ";
  const MSG_DATA_ERROR = "Error: input data do not match with its type or be left empty - ";
  const MSG_CONNECT_PDO_EXCEPTION = "Error: Unable to establish database connection - ";  
  
  protected $DB_CONNECTION;
  public function __construct() {
    $db = new \App\Core\Database();
    $this->DB_CONNECTION = $db->getConnection();
  }


  /**
   * Executes a database query and returns the result set.
   *
   * @param string $sql The SQL query to execute.
   * @param \PDO $connection The database connection object.
   * @param int $fetchMode The fetch mode for the result set. Default is PDO::FETCH_ASSOC.
   * @param array $params The parameters to bind to the query. Default is an empty array.
   * @return array The result set as an array of objects of the calling class.
   * @throws \Exception If the query execution fails.
   */
  static protected function query($sql, $connnection, $fetchMode = \PDO::FETCH_ASSOC, $params = []){
    $stmt = $connnection->prepare($sql);

    if (!empty($params))
      foreach ($params as $key => $value)
        $stmt->bindValue($key, $value);

    if ($stmt->execute()) {
      $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
      return $stmt->fetchAll($fetchMode);
    } else {
      throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    }
  }
}