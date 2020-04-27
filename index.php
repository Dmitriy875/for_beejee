<?php

use View\View;
require_once( "app.php" );

$auth->controller->auth( $authResult );
$app->view->loadHeader();

require_once( "view/templates/" . View::$currentTemplate . "/content.php" );

?>
