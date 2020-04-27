<?php
namespace App;

use Core\Auth;
use View\View;
use Model\Model;
use Model\AuthModel;
use Controller\Controller;
use View\AuthView;
use Controller\AuthController;
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




$auth = new Auth( new AuthModel, new AuthView, new AuthController );
$safeAuthData = $auth->controller->safeAuth();
$authResult = $auth->model->authQuery( $safeAuthData );




// $auth->auth();

?>
