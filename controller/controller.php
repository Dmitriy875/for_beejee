<?php
namespace Controller;
use View\View;
use View\PaginationView;
use Model\Model;
use Model\PaginationModel;

class Controller {
  public $test = "Класс " . __CLASS__ . " в работе.";

  public function load() {
    echo $this->test;
  }
}

class PaginationController {
  private $numOfAllItems;
  private $numOfItemsToShow;
  private $currentPage;
  private $numOfAllPages;
  public $model;

  public function getCurrentPage() {
    if( $_GET['current_page'] ) {
      $this->currentPage = $_GET['current_page'];
    } else
        return $this->currentPage = 1;
  }

  public function paginatorCurrentPage() {
    return ($this->currentPage -1) * $this->numOfItemsToShow;
  }

  public function getNumOfAllPages() {
    if( ( $this->numOfAllItems % $this->numOfItemsToShow) == 0 ) {
      $num = $this->numOfAllItems / $this->numOfItemsToShow;
    } else {
        $num = round( $this->numOfAllItems / $this->numOfItemsToShow, PHP_ROUND_HALF_UP );
    }
      return $this->numOfAllPages = $num;
  }

  public function getNumOfItemsToShow() {
    return $this->numOfItemsToShow = 3;
  }


  public function __construct( View $view, Model $model ) {
    $this->numOfAllItems = $model->getNumOfItems(true);
    $this->model = $model;
  }

}

?>
