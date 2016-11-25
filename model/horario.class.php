<?php
  class Horario {
    private $dia_semana;
    private $hora_inicio;
    private $hora_fim;
    public function setHoraInicio($hora_inicio){
      $this->hora_inicio = $hora_inicio;
    }
    public function setHoraFim($hora_fim){
      $this->hora_fim = $hora_fim;
    }
    public function getHoraInicio(){
      return $this->hora_inicio;
    }
    public function getHoraFim(){
      return $this->hora_fim;
    }
    public function setDiaSemana($dia_semana){
      if($dia_semana>=0 and $dia_semana <= 6)
        $this->dia_semana = $dia_semana;
    }
    public function getDiaSemana($dia_semana){
      return $this->dia_semana;
    }
  }
?>
