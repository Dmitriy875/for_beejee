<?php
namespace View;

// require_once( "app.php" );
class View {

  public $templates = array(
    "zen",
  );

  public static $currentTemplate = "zen";

  public static $trustedCssFiles = array(
    "bootstrap.min.css" => "zen",
  );

  public static $cssFilesToConnect = array();

  // NOTE: Looks like schizophrenia. Maybe. But I really like to check everything.
  public static function getCssFiles() {
    foreach( self::$trustedCssFiles as $cssFile => $template) {
      $filePath = "view/templates/" . self::$currentTemplate."/css/" . $cssFile;
      if( file_exists( $filePath ) ){
        self::$cssFilesToConnect[] .= $filePath;
      }
    }
  }

  public function includeCssFiles() {
    // if($this->cssFilesToConnect)
    foreach( self::$cssFilesToConnect as $file ) {
      echo "<link rel='stylesheet' href='" . $file . "'>";
    }
  }

// NOTE: Paginator doesn't need to know about them:
  public function loadHeader() {
    require_once( "view/templates/" . static::$currentTemplate . "/header.php");
  }

  public function loadContent() {
    require_once( "view/templates/" . static::$currentTemplate . "/content.php");
  }
}


class PaginationView extends View {
  public function test() {
    echo __CLASS__ . "подключен";
  }
}

?>
