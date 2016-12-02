<?php
  class Horario {
    private $horario_inicio;
    private $horario_fim;
    public function __construct(){
      $num_args = func_num_args();
      if($num_args == 2){
        $this->horario_inicio = func_get_arg(0);
        $this->horario_fim = func_get_arg(1);
      }
    }
    public function setHorarioInicio($horario_inicio){
      $this->horario_inicio = $horario_inicio;
    }
    public function setHorarioFim($horario_fim){
      $this->horario_fim = $horario_fim;
    }
    public function getHorarioInicio(){
      return $this->horario_inicio;
    }
    public function getHorarioFim(){
      return $this->horario_fim;
    }
  }
?>
