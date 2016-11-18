<?php
  class Estabelecimento  {
    private $cnpj;
    private $nome_fantasia;
    private $razao_social;
    private $responsavel;
    private $telefone;
    private $site;
    /*Talvez*/
    private $n_funcionario;
    public function __construct(/**/){
        $num_args = func_num_args();
        if($num_args==3)
        {
          $this->setCnpj(func_get_arg(0));
          $this->setNomeFantasia(func_get_arg(1));
          $this->setRazaoSocial(func_get_arg(2));
        }
    }
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
    public function setTelefone($telefone){
      $this->telefone = $telefone;
    }
    public function getTelefone(){
      return $this->telefone;
    }
    public function getSite(){
      return $this->site;
    }
    public function setSite($site){
      $this->site = $site;
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
