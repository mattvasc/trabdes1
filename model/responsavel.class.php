<?php
  class Responsavel {
    private $cpf;
    private $nome;
    private $telefone;
    private $email;

  public function __construct(/* cpf, nome, telfone, [email] */){
      $num_args = func_num_args();
      if($num_args >= 3){
        $this->setCpf(func_get_arg(0));
        $this->setNome(func_get_arg(1));
        $this->setTelefone(func_get_arg(2));
      }
      if($num_args == 4)
      $this->setEmail(func_get_arg(3));
  }

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
