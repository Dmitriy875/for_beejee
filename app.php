<?php
namespace App;

use Core\Auth;
use Core\Paginator;
use Model\Model;
use Model\AuthModel;
use Model\PaginationModel;
use View\PaginationView;
use View\AuthView;
use View\View;
use Controller\Controller;
use Controller\AuthController;
use Controller\PaginationController;


require_once( "core.php" );

class App {
  public $model;
  public $view;
  public $controller;


  public function __construct( Model $model, View $view, Controller $controller ) {
    $this->model      = $model;
    $this->view       = $view;
    $this->controller = $controller;
  }
}

$app = new App( new Model,
                new View,
                new Controller );


$paginator = new Paginator(   new PaginationController,
                              new PaginationView,
                              new PaginationModel   );



$auth = new Auth( new AuthModel,
                  new AuthView,
                  new AuthController );

// Auth
$safeAuthData = $auth->controller->safeAuth();
$authResult   = $auth->model->authQuery( $safeAuthData );

// Paginator

$numOfAllItems = $app->model->getNumOfItems();

$paginator->controller->getCurrentPage();
$paginator->controller->getNumOfItemsToShow();

// NOTE: Set GET-param as settings of number of items at one page



$dbResult = $paginator->model->selectByGetParam(  $paginator->controller->paginatorCurrentPage(),
                                                  $paginator->controller->getNumOfItemsToShow() );






?>
