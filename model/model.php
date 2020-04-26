<?php

namespace Model;
use Config\DatabaseConnection;


class Model {

}


abstract class Queries extends Model {
  public $sql = "SELECT * FROM task_book";

}

class PaginationModel extends Queries {
  public $sql = "SELECT * FROM task_book ";

  // NOTE: Returns nubmer of items matching the query $sql
  public function getNumOfItems() {
    if( isset( $_GET['sort'] ) AND isset( $_GET['type'] ) )
      $sort = " ORDER BY " . $_GET['type'] . " " . $_GET['sort'];



    if( isset( $_GET['name'] ) ) {
      $this->sql .= "WHERE user = '$_GET[name]'";
    }
    elseif ( $_GET['email'] ) {
      $this->sql .= "WHERE email = '$_GET[email]'";
    }
    elseif ( $_GET['status'] ) {
      $this->sql .= "WHERE status = '$_GET[status]'";
    }
    else {
      $this->sql .= $sort;
    }
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $this->sql );
    $stmt->execute();
    $result = $stmt->fetchAll();

    // Count all notes in DB
    return count( $result );
  }

  public function selectByGetParam( $start, $limit ) {
    $setLimit = " LIMIT " . $start;
    $startFrom = ", " . $limit;
    if( $_GET['name'] ) {
      $dbResult = self::getOrderBy( $this->sql . $setLimit . $startFrom );
    } elseif ( $_GET['email'] ) {
      $dbResult = self::getOrderBy( $this->sql . $setLimit . $startFrom );
    } elseif ( $_GET['status'] ) {
      $dbResult = self::getOrderBy( $this->sql . $setLimit . $startFrom );
    } else {
        $dbResult = self::getOrderBy( $this->sql . $setLimit . $startFrom );
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
