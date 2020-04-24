<?php
namespace Model;
use Config\DatabaseConnection;
class Model {

}


abstract class Queries extends Model {
  public $sql = "SELECT * FROM task_book";

}

class PaginationModel extends Queries {

  public function selectByGetParam() {
    if( $_GET['name'] ) {
      $dbResult = self::getOrderBy( "SELECT * FROM task_book WHERE user = '$_GET[name]'");
    } elseif ( $_GET['email'] ) {
      $dbResult = self::getOrderBy( "SELECT * FROM task_book WHERE email = '$_GET[email]'");
    } elseif ( $_GET['status'] ) {
      $dbResult = self::getOrderBy( "SELECT * FROM task_book WHERE status = '$_GET[status]'");
    } else {
        $dbResult = self::getOrderBy( "SELECT * FROM task_book" );
      }
    return $dbResult;

  }


  public static function getOrderBy( $sql ) {
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  public function getNumOfItems() {
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $this->sql );
    $stmt->execute();
    $result = $stmt->fetchAll();

    // Count all notes in DB
    return count( $result );
  }

  public function getAllItems() {
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $this->sql );
    $stmt->execute();
    $result = $stmt->fetchAll();

    // All items
    return $result;
  }
}

?>
