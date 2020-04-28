<?php
namespace View;

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
    foreach( self::$cssFilesToConnect as $file ) {
      echo "<link rel='stylesheet' href='" . $file . "'>";
    }
  }

// NOTE: Paginator doesn't need to know about them:
  public function loadHeader() {
    require_once( "view/templates/" . static::$currentTemplate . "/header.php");
  }

  public function loadContent( $Result ) {
    require_once( "view/templates/" . static::$currentTemplate . "/content.php");
    $dbResult = $Result;
    print_r( $dbResult );
  }
}


class PaginationView extends View {
  public function statusColor( $color ) {
    if( $color == "failed" )
      return "danger";
    elseif( $color == "complete" )
      return "success";
    elseif( $color == "in progress" )
      return "primary";
  }
}

class TaskView extends View {
  public $queryPermission = false;

  public function getForm() {
    require_once( "view/templates/zen/form.php" );
  }
  public function formValidation() {
    $error = "";
    if( $_POST['create_try'] ) {
      if( $_POST['email']
          AND (!strstr( $_POST['email'], '@' )
              OR strlen( $_POST['email'] ) < 5 ) )  {
        $error .= "<p><div class='alert alert-danger'> Incorrect <b>email</b> value</div></p>";
      }

      foreach( $_POST as $name => $postItem ) {
        if( empty( $postItem ) ) {
          $error .= "<p><div class='alert alert-danger'> <b>" . ucfirst( $name ) . "</b> field is empty!</div></p>";
        }
      }
      if( empty( $error ) ) {
        $this->queryPermission = true;
        return $success = "<p><div class='alert alert-success'>Task is successfully created.</div></p>";

      }
      return $error;
    }
  }
}

class AuthView extends View {
  public function loadAuthForm() {
    file_get_contents( "view/templates/zen/auth_form.html" );
  }
  public function notify( $reject ) {
    // if( $reject == false )
    return "<div class='alert alert-danger'>Incorrect data.</div>";
  }
}

class AdminView extends View {

}

?>
