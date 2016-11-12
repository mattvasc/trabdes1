<?php
  class Estabelecimento  {
    private $cnpj;
    private $nome_fantasia;
    private $razao_social;
    private $responsavel;
    /*Talvez*/
    private $n_funcionario;

    public function addResponsavel(Responsavel $responsavel){
      array_push($this->responsavel, $responsavel);
    }
    public function getResponsavel(){
      return $this->responsavel;
    }
    public function getCnpj() {
        return $this->cnpj;
    }
    public function getNomeFantasia(){
      return $this->nome_fantasia;
    }
    public function getRazaoSocial(){
      return $this->razao_social;
    }
    public function getNFuncionario(){
      return $this->n_funcionario;
    }
    public function setCnpj($cnpj){
      // Me valide antes!
      $this->cnpj = $cnpj
    }
    public function setNomeFantasia($nome_fantasia){
      $this->nome_fantasia = $nome_fantasia;
    }
    public function setRazaoSocial($razao_social){
      $this->razao_social = $razao_social;
    }
    public function setNFuncionario($n_funcionario){
      $this->n_funcionario = $n_funcionario;
    }
    public function salvar(){
      //Lógica necessária para salvar
    }
    public function selecionar(/*args*/){
      //Lógica necessária para selecionar
    }
  }
