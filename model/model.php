<?php
namespace Model;
class Model {
  public $test = "Класс " . __CLASS__ . " в работе.";

  public function load() {
    echo $this->test;
  }
}


?>
