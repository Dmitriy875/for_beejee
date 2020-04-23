<?php
namespace Model;
use Config\DatabaseConnection;
class Model {
  // public $test = "Класс " . __CLASS__ . " в работе.";

  // public function load() {
    // echo $this->test;
  // }
}


class Queries extends Model {

  public static function getOrderBy( $sql ) {
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }
}

class PaginationModel extends Queries {
  public function getNumOfItems() {
    $sql = "SELECT * FROM task_book";
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();

    // Count all results
    return count( $result );
  }
}

?>
