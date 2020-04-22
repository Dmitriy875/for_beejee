<?php
namespace Controller;
class Controller {
  public $test = "Класс " . __CLASS__ . " в работе.";

  public function load() {
    echo $this->test;
  }
}


?>
