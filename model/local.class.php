<?php
  class Local{
    private $setor;
    private $substor;
    private $area;
    public function getSetor(){
      return $this->setor;
    }
    public function setSetor($setor){
      $this->setor = $setor;
    }
    public function getSubsetor(){
      return $this->subsetor;
    }
    public function setSubsetor($subsetor){
      $this->subsetor = $subsetor;
    }
    public function getArea(){
      return $this->area;
    }
    public function setArea($area){
      if($area>0)
        $this->area = $area;
    }
  }
?>
