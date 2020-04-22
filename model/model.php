<?php
namespace Model;
use Config\DatabaseConnection;
class Model {
  public $test = "Класс " . __CLASS__ . " в работе.";

  public function load() {
    echo $this->test;
  }
}


class Queries {

  public static function getOrderBy( $sql ) {
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }
}

?>
