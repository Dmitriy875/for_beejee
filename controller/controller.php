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
  private $currentPage;
  private $pagesToShow;
  private $numOfItemsToShow;
  private $numOfAllItems;
  private $numOfAllPages;

  public function getCurrentPage() {
    if( $_GET['current_page'] ) {
      $this->currentPage = $_GET['current_page'];
    } else
        return $this->currentPage = 1;
  }

  public function getPagesToShow() {
    if( $_GET['pages_to_show'] ) {
      $this->pagesToShow = $_GET['pages_to_show'];
    } else
        return $this->pagesToShow = 3; // NOTE: There can be less than three pages, be carefull
  }

  public function getNumOfAllPages() {
    if( $this->numOfAllItems <= 0 ) {
      return $this->numOfAllPages = 1;
    } else {
      $this->numOfAllPages = $this->numOfAllItems / $this->numOfItemsToShow;
      return $this->numOfAllPages;
    }
  }

  public function getNumOfItemsToShow() {
    return $this->numOfItemsToShow = 3;
  }


  public function __construct( View $view, Model $model ) {
    $this->numOfAllItems = $model->getNumOfItems();
  }

}

?>
