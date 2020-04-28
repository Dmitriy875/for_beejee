<?php

namespace Model;
use Config\DatabaseConnection;
use Core\Utilities;


class Model {
  public $sql = "SELECT * FROM task_book ";

  public function dbAsk() {
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $this->sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  public function sqlModify() {
    if( isset( $_GET['sort'] ) AND isset( $_GET['type'] ) )
      $sort = " ORDER BY " . $_GET['type'] . " " . $_GET['sort'];

    if( isset( $_GET['name'] ) ) {
      $this->sql .= " WHERE user = '$_GET[name]'";
    }
    elseif ( $_GET['email'] ) {
      $this->sql .= " WHERE email = '$_GET[email]'";
    }
    elseif ( $_GET['status'] ) {
      $this->sql .= " WHERE status = '$_GET[status]'";
    }
    else {
      $this->sql .= $sort;
    }
    return $this->sql;
  }


  // NOTE: Returns nubmer of items matching the query $sql
  public function getNumOfItems() {
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( self::sqlModify() );
    $stmt->execute();
    $result = $stmt->fetchAll();

    // Count all notes in DB
    return count( $result );
  }
}


abstract class Queries extends Model {
  public $sql = "SELECT * FROM task_book";

}

class PaginationModel extends Queries {

  public function selectByGetParam( $start, $limit ) {
    $sql = self::sqlModify();

    $setLimit = " LIMIT " . $start;
    $startFrom = ", " . $limit;

    if( $_GET['name'] ) {
      $dbResult = self::getOrderBy( $sql . $setLimit . $startFrom );
    }
    elseif ( $_GET['email'] ) {
      $dbResult = self::getOrderBy( $sql . $setLimit . $startFrom );
    }
    elseif ( $_GET['status'] ) {
      $dbResult = self::getOrderBy( $sql . $setLimit . $startFrom );
    }
    else {
      $dbResult = self::getOrderBy( $sql . $setLimit . $startFrom );
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

class TaskModel extends Model {
  use Utilities;
  public function createTask( $insecurePost ) {
    $name   = self::disarm( $insecurePost['name'] );
    $email  = self::disarm( $insecurePost['email'] );
    $task   = self::disarm( $insecurePost['task'] );

    $sql = "INSERT INTO task_book (user, email, task, status)
            VALUES ('$name', '$email', '$task', 'new')";

    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }
}


class AuthModel extends Model {
  private $authPermission = false;

  public function authQuery( $safeAuthData ) {

    $sql = "SELECT name, password
            FROM users WHERE name = '$safeAuthData[admin_name]'AND password = '$safeAuthData[admin_password]'";

    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    if( !empty( $result ) ) {
      return $this->authPermission = true;
    }
    else
      return $this->authPermission = false;
  }
}

class AdminModel extends Model {
  use Utilities;
  public function getStatuses() {
    $sql = "SELECT status FROM task_book";
    $config = DatabaseConnection::getInstance();
    $stmt	= $config->pdo->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  public function updateAll( $logInCheck ) {
    if( !$logInCheck ) {
      return false;
    } else {
      $task = self::disarm( $_POST['task'] );
      $status = self::disarm( $_POST['status'] );
      $sql = "UPDATE task_book
              SET task    = '$task',
                  status  = '$status',
                  admin_edit = true
              WHERE id = '$_POST[id]';

              ";
      $config = DatabaseConnection::getInstance();
      $stmt	= $config->pdo->prepare( $sql );
      $stmt->execute();
    }
  }

  public function updateStatus( $logInCheck ) {
    if( !$logInCheck ) {
      return false;
    } else {
      $status = self::disarm( $_POST['status'] );
      $sql = "UPDATE task_book
      SET status  = '$status'
      WHERE id = '$_POST[id]';

      ";
      $config = DatabaseConnection::getInstance();
      $stmt	= $config->pdo->prepare( $sql );
      $stmt->execute();
    }
  }
}

?>
