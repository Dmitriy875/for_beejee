<?php
namespace Core;

use Model\Model;
use View\View;
use Controller\Controller;
use Config\Config;
use Model\AuthModel;
use View\AuthView;

require_once( "config.php " );

set_include_path( get_include_path() . PATH_SEPARATOR . "c:/OpenServer/domains/beejee-test/");

class Core {
  private $config;

  public function __construct( Config $config ) {
    $this->config = $config->configDirs;
  }

  public function findAppComponents() {
    foreach( $this->config as $className => $dirPath ) {
      if( file_exists( $dirPath ) ) {
         require_once( $dirPath );
          // TODO: Make Exceptions
      }
    }
  }
}

$core = new Core( new Config );
$core->findAppComponents();

class Auth {
  public function __construct( Model $model, View $view, Controller $controller ) {
    $this->model = $model;
    $this->view = $view;
    $this->controller = $controller;
  }
}


?>
