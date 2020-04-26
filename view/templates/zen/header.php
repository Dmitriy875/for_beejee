<?php

use View\View;
require_once("app.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="view\templates\zen\js\jquery-3.5.0.min.js" charset="utf-8"></script>
  <!-- <script src="view\templates\zen\js\projectScript.js" charset="utf-8"></script> -->


  <title>Zen | Task-table</title>

  <?php

  View::getCssFiles();
  View::includeCssFiles();

  ?>

</head>
