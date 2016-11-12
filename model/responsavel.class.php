<?php
  class Responsavel {
    private $cpf;
    private $nome;
    private $telefone;
    private $email;
    public function getCpf(){
      return $this->cpf;
    }
    public function getNome(){
      return $this->nome;
    }
    public function getTelefone(){
      return $this->telefone;
    }
    public function getEmail(){
      return $this->email;
    }
    public function setCpf($cpf){
      // Se o cpf for válido
      $this->cpf = $cpf;
    }
    public function setNome($nome){
      $this->nome = $nome;
    }
    public function setTelefone($telefone){
      $this->telefone = $telefone;
    }
    public function setEmail($email){
      $this->email = $email;
    }
  }

?>
