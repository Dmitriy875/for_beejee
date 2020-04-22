<?php

require_once( "config.php " );

class Core {
  private $config;

  public function __construct( Config $config ) {
    $this->config = $config->configDirs;
  }

  public function findAppComponents() {
    foreach( $this->config as $className => $dirPath ) {
      if( file_exists( $dirPath ) ) {
         require_once( $dirPath );
         if( !class_exists( $className ) )
          die("No");  // TODO: Make Exceptions
      }
    }
  }
}

$core = new Core( new Config );
$core->findAppComponents();

?>
