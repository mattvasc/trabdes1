<?php
  class Estabelecimento  {
    private $cnpj;
    private $nome_fantasia;
    private $razao_social;
    private $responsavel;
    private $telefone;
    private $site;
    private $setor;
    private $subsetor;
    private $data_inicio;
    private $horario_incio;
    private $horario_fim;
    private $data_fim;
    private $categoria;
    private $n_funcionario;
    public function __construct(/* cnpj, nome_fantasia, razao_social, setor, subsetor, data_inicio, horario, [data_fim, ]*/){
        $this->categoria = array();
        $this->responsavel = array();
        $this->n_funcionario = 0;
        $num_args = func_num_args();
        if($num_args>=7)
        {
          $this->setCnpj(func_get_arg(0));
          $this->setNomeFantasia(func_get_arg(1));
          $this->setRazaoSocial(func_get_arg(2));
          $this->setSetor(func_get_arg(3));
          $this->setSubSetor(func_get_arg(4));
          $this->setDataInicio(func_get_arg(5));
          $this->setHorario(func_get_arg(6));
        }
        if($num_args>=8)
        $this->setDataFim(func_get_arg(6));
    }
    public function addResponsavel(Responsavel $responsavel){
      $this->responsavel[] = $responsavel;
    }
    public function getHorarioFim(){
      return $this->horario_fim;
    }
    public function getHorarioInicio(){
      return $this->horario_inicio;
    }
    public function setHorarioFim($horario){
      $this->horario_fim = $horario;
    }
    public function setHorarioInicio($horario){
      $this->horario_inicio = $horario;
    }
    public function addCategoria($categoria){
      $this->categoria[] = $categoria;
    }
    public function getCategoria(){
      return $this->categoria;
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
      // Me valide antes! ou não.
      $this->cnpj = $cnpj;
    }
    public function setSetor($setor){
      $this->setor = $setor;
    }
    public function setSubSetor($subsetor){
      $this->subsetor = $subsetor;
    }
    public function getSetor(){
      return $this->setor;
    }
    public function getSubSetor(){
      return $this->subsetor;
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
    public function setDataInicio($data)    {
      $this->data_inicio = implode('-', array_reverse(explode('/', $data)));
    }
    public function setDataFim($data)    {
      $this->data_fim = implode('-', array_reverse(explode('/', $data)));
    }
    public function getDataInicio(){
      return $this->data_inicio;
    }
    public function getDataFim(){
      return $this->data_fim;
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
      // Retorna null se salvou, else o erro
      require_once('../control/Connection.php');
      $conn = Connection::open();
      $query = "SELECT * FROM `estabelecimento` WHERE `cnpj` = '$this->cnpj';";
      $result = mysqli_query($conn,$query);
      if(!mysqli_fetch_assoc($result))
        mysqli_query($conn, "INSERT INTO `estabelecimento` (`cnpj`, `nome_fantasia`, `razao_social`, `n_funcionario`) VALUES ('$this->cnpj', '$this->nome_fantasia', '$this->razao_social', $this->n_funcionario);");
      else
        mysqli_query($conn,"UPDATE `estabelecimento` SET `nome_fantasia`='$this->nome_fantasia',`razao_social`='$this->razao_social', `n_funcionario`=$this->n_funcionario WHERE `cnpj` = '$this->cnpj';");

      if(!empty($this->telefone)){
        $query = "UPDATE `estabelecimento` SET `telefone`= '$this->telefone' WHERE  `cnpj`= '$this->cnpj';";
        mysqli_query($conn, $query);
      }
      if(!empty($this->site))
        mysqli_query($conn, "UPDATE `estabelecimento` SET `site`= '$this->site' WHERE  `cnpj`= '$this->cnpj';");

      $result = mysqli_query($conn, $query);
      if(!$result){
        Connection::closeConnection($conn);
        return 0;
      }
      // Inserindo as categorias no que esse estabelecimento se associa no banco:
      if(!empty($this->categoria)){
        foreach ($this->categoria as $c) {
            $result = mysqli_query($conn, "INSERT INTO `estabelecimento_categoria`(`cnpj`, `nome`) VALUES ('$this->cnpj', '".$c."');");
          if(!$result){
            Connection::closeConnection($conn);
            return 0;
          }
        }
      }
      //Inserindo o horário de funcionamento
      if(!empty($this->horario)){
        $query =
      }
      //Inserindo o local que esse estabelecimento fica:
      if(!empty($this->setor) && !empty($this->subsetor)  && !empty($this->data_inicio)){
        if(!empty($this->data_fim))
          $query = "INSERT INTO `estabelecimento_local`(`cnpj`, `setor`, `subsetor`, `data_inicio`, `data_fim`) VALUES ('$this->cnpj','$this->setor','$this->subsetor',$this->data_inicio,$this->data_fim);";
        else
          $query = "INSERT INTO `estabelecimento_local`(`cnpj`, `setor`, `subsetor`, `data_inicio`) VALUES ('$this->cnpj','$this->setor','$this->subsetor',$this->data_inicio);";
        mysqli_query($conn,$query);
      }
      Connection::closeConnection($conn);
      return 1;
    }
    public function carregar(/*cnpj*/){
      //Lógica necessária para selecionar
      $this->cnpj = func_get_arg(0);
      $conn = Connection::open();
      $query = "SELECT * FROM `estabelecimento` WHERE `cnpj` = '$this->cnpj';";
      $result = mysqli_query($conn,$query);
      Connection::closeConnection($conn);
      if($result){
        $row = mysqli_fetch_assoc($result);
        $this->razao_social = $row['razao_social'];
        $this->nome_fantasia = $row['nome_fantasia'];
        $this->n_funcionario = $row['n_funcionario'];
        $this->site = $row['site'];
        $this->telefone = $row['telefone'];
        return 1;
      }
      else
        return 0;
    }
  }
