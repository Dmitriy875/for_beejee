<?php
session_start();
if( !$_SESSION['authenticated'] ) {
  header( "Location: /");
}
?>
