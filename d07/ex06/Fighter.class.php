<?php
  abstract class Fighter
  {
    public  $good = 0;
    
    public function __construct($solj) {
      $good = 1;
    }
    
    public function get_solj() {
      return ($this->good);
    }
    abstract protected function fight($t);
}
?>