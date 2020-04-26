<?php

namespace Controller;
use View\View;
use View\PaginationView;
use Model\Model;
use Model\PaginationModel;

class Controller {

}

class PaginationController extends Controller {
  private $numOfAllItems;
  private $numOfItemsToShow;
  private $currentPage;
  private $numOfAllPages;
  public $model;
  public $dynamicNumOfPages;

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

  // NOTE: Number of page for sql-query, $start for LIMIT ...
  public function paginatorCurrentPage() {
    return ($this->currentPage -1) * $this->numOfItemsToShow;
  }

  // NOTE: Number of pages on paginator scale
  public function getNumOfAllPages() {
    if( ( $this->numOfAllItems % $this->numOfItemsToShow) == 0 )
      $num = $this->numOfAllItems / $this->numOfItemsToShow;
    else
      $num = round( $this->numOfAllItems / $this->numOfItemsToShow, PHP_ROUND_HALF_UP );
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

  public function __construct( View $view, Model $model ) {
    // NOTE: Saves number of items, getting by sql-query from model
    $this->numOfAllItems = $model->getNumOfItems();

    // NOTE: Set GET-param as settings of number of items at one page
    $this->model = $model;
  }

}

?>
