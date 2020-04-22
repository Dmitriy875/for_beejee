<?php

class View {

  public $templates = array(
    "zen",
  );

  public $currentTemplate = "zen";

  public $trustedCssFiles = array(
    "bootstrap.min.css" => "zen",
  );

  public $cssFilesToConnect = array();

  // NOTE: Looks like schizophrenia. Maybe. But I really like to check everything.
  public function getCssFiles() {
    foreach( $this->trustedCssFiles as $cssFile => $template) {
      if( file_exists( "view/templates/" . $this->currentTemplate."/css/" . $cssFile)){
        $this->cssFilesToConnect[] .= $cssFile;
      }
    }
  }

  public function includeCssFiles() {
    // if($this->cssFilesToConnect)
    foreach( $this->cssFilesToConnect as $file ) {
      echo "<link rel='stylesheet' href='" . $file . "'>";
    }
  }

  public function loadHeader() {
    require_once( "templates/" . $this->currentTemplate . "/header.php");
  }

  public function loadContent() {
    require_once( "templates/" . $this->currentTemplate . "/content.php");
  }
}

?>
