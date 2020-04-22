<?php

require_once( "config.php " );

class App {
  public $model;
  public $view;
  public $controller;

  // public function __construct( Model $model, View $view, Controller $controller ) {
  //   $this->model     = $model;
  //   $this->view      = $view;
  //   $this->controler = $controller;
  // }

  public function findAppComponents() {
    if( file_exists( $modelPath ) AND file_exists( $viewPath ) AND file_exists( $controllerPath )) {
      echo "gut";
    }
  }
}

$app = new App;
$app->findAppComponents();

?>
