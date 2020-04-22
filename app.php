<?php

require_once( "core.php" );

class App {
  public $model;
  public $view;
  public $controller;


  public function __construct( Model $model, View $view, Controller $controller ) {
    $this->model     = $model;
    $this->view      = $view;
    $this->controller = $controller;
  }


}

$app = new App( new Model,
                new View,
                new Controller
                );

// $app->model->load();
// $app->controller->load();

?>
