<?php
  class Local{
    private $setor;
    private $substor;
    private $data_inicio;
    private $data_fim;
    public function __construct(){
      /* Oi mundo =))) */
    }
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
    public function getDataInicio(){
      return $this->data_inicio;
    }
    public function getDataFim(){
      return $this->data_fim;
    }
    public function setDataInicio($data_inicio){
      $this->data_inicio = $data_inicio;
    }
    public function setDataFim($data_fim){
      $this->data_fim = $data_fim;
    }
  }
?>
