<?php

require_once( "app.php" );

$auth->controller->auth( $authResult );
$app->view->loadHeader();

// $auth->controller->auth();

$app->view->loadContent();


?>
