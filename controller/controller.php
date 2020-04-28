<?php

namespace Controller;

use View\View;
use Model\Model;
use Core\Utilities;

class Controller {
  public function session() {
    session_start();

    if( $_GET['auth'] === "logout" )  {
      session_unset();
      session_destroy();
    }
  }

}

class PaginationController extends Controller {
  private $numOfAllItems;
  private $numOfItemsToShow;
  private $currentPage;
  private $numOfAllPages;
  public $model;
  public $view;


  // NOTE: Get number of current paga from $_GET
  public function getCurrentPage() {
    if( $_GET['current_page'] )
      $this->currentPage = $_GET['current_page'];
    else
      return $this->currentPage = 1;
  }

  // NOTE: Select number of items to show on page
  public function getNumOfItemsToShow() {
    return $this->numOfItemsToShow = 3;
  }

  // NOTE: Number of page for sql-query, $start for LIMIT in selectByGetParam()
  public function paginatorCurrentPage() {
    return ($this->currentPage -1) * $this->numOfItemsToShow;
  }

  // NOTE: Number of pages on paginator scale
  public function getNumOfAllPages( $numOfAllItems ) {
    if( ( $numOfAllItems % $this->numOfItemsToShow) == 0 )
      $num = $numOfAllItems / $this->numOfItemsToShow;
    else
      $num = round( $numOfAllItems / $this->numOfItemsToShow, PHP_ROUND_HALF_UP );
      return $this->numOfAllPages = $num;
  }

  public function navPrevious() {
    if( $this->currentPage == 1 )
      return 1;
    else
      return $this->currentPage - 1;
  }

  public function navNext() {
    if( $this->currentPage < $this->numOfAllPages )
      return $this->currentPage + 1;
    else
      return $this->currentPage;
  }
}

class TaskController {
  public $model;
  public $view;

  public function __construct( Model $model, View $view ) {
    $this->model = $model;
    $this->view  = $view;
  }
}






class AuthController extends Controller {
  use Utilities;
  public function safeAuth() {
    $safePost = array();
    if( isset( $_POST['auth_try'] ) ) {
      foreach( $_POST as $postItemName => $postItemValue ) {
        $safePost[$postItemName] = self::disarm( $postItemValue );
      }
      return $safePost;
    }
  }

  public function auth( $answer ) {
    if( $answer == true ) {
      session_start();
      $_SESSION['authenticated'] = true;
      header( "Location: /admin.php ");
    }
  }
}

class AdminController extends Controller {
  public function sessionCheck() {
    if( !$_SESSION['authenticated'] ) {
      header( "Location: /");
      return false;
    } else
        return true;
  }
}

?>
