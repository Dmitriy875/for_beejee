<?php

class View {

  public $currentTemplate = "zen";

  public $trustedCssFiles = array(
    "view\css\bootstrap.min.css" => "zen",
  );

  public $cssFilesToConnect = array();

  // NOTE: Looks like schizophrenia. Maybe. But I really like to check everything.
  public function getCssFiles() {
    foreach( $this->trustedCssFiles as $cssFile => $template) {
      if( file_exists( $cssFile ) AND $template == "zen" ){
        $this->cssFilesToConnect[] .= $cssFile;
      }
    }
    print_r( $cssFilesToConnect );
    return $cssFilesToConnect;
  }

  public function includeCssFiles() {
    foreach( $this->cssFilesToConnect as $file ) {
      echo "<link rel='stylesheet' href=" . $file . ">";
    }
  }

  public function showContent() {
    echo "content";
  }
}


?>
