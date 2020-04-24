<?php
namespace Model;
use Config\DatabaseConnection;
class Model {

}


abstract class Queries extends Model {
  public $sql = "SELECT * FROM task_book";

}

class PaginationModel extends Queries {

  public function selectByGetParam( $start, $limit ) {
    $setLimit = "LIMIT " . $start;
    $startFrom = ", " . $limit;
    if( $_GET['name'] ) {
      $dbResult = self::getOrderBy( "SELECT * FROM task_book WHERE user = '$_GET[name]'" . $setLimit . $startFrom );
    } elseif ( $_GET['email'] ) {
      $dbResult = self::getOrderBy( "SELECT * FROM task_book WHERE email = '$_GET[email]'" . $setLimit . $startFrom );
    } elseif ( $_GET['status'] ) {
      $dbResult = self::getOrderBy( "SELECT * FROM task_book WHERE status = '$_GET[status]'" . $setLimit . $startFrom );
    } else {
        $dbResult = self::getOrderBy( "SELECT * FROM task_book " . $setLimit . $startFrom );
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
