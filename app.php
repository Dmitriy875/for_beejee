<?php
namespace App;

use View\View;
use Model\Model;
use Controller\Controller;

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


$app->view->loadHeader();
$app->view->loadContent();


?>
