<?php
  require_once("horario.class.php");
  require_once("local.class.php");
  // require_once('');
  class Estabelecimento  {
    private $cnpj;
    private $nome_fantasia;
    private $razao_social;
    private $responsavel;
    private $telefone;
    private $site;
    private $local;
    private $horario;
    private $categoria;
    private $n_funcionario;
    public function __construct(/* cnpj, nome_fantasia, razao_social, setor, subsetor, data_inicio, horario, [data_fim, ]*/){
      //$_POST['cnpj'], $_POST['nome_fantasia'], $_POST['razao_social'], $_POST['setor'], $_POST['subsetor'], $_POST['data_inicio'], $_POST['horario']);
        $this->categoria = array();
        $this->responsavel = array();
        $this->n_funcionario = 0;
        $this->horario = new Horario();
        $this->local = new Local();
        $num_args = func_num_args();
        if($num_args>=1){
          $this->setCnpj(func_get_arg(0));
        }
        if($num_args>=7)
        {
          $this->setNomeFantasia(func_get_arg(1));
          $this->setRazaoSocial(func_get_arg(2));
          $this->local->setSetor(func_get_arg(3));
          $this->local->setSubSetor(func_get_arg(4));
          $this->setDataInicio(func_get_arg(5));
          $arrai = explode(",",func_get_arg(6));
          $this->horario->setHorarioInicio($arrai[0]);
          $this->horario->setHorarioFim($arrai[1]);
        }
        if($num_args>=8)
        $this->setDataFim(func_get_arg(6));
    }
    public function addResponsavel(Responsavel $responsavel){
      $this->responsavel[] = $responsavel;
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
      $this->local->setSetor($setor);
    }
    public function setSubSetor($subsetor){
      $this->setSubSetor($subsetor);
    }
    public function getHorarioInicio(){
      return $this->horario->getHorarioInicio();
    }
    public function getHorarioFim(){
      return $this->horario->getHorarioFim();
    }
    public function getSetor(){
      return $this->local->getSetor();
    }
    public function getSubSetor(){
      return $this->local->getSubSetor();
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
      $this->local->setDataInicio(implode('-', array_reverse(explode('/', $data))));
    }
    public function setDataFim($data)    {
      $this->local->setDataFimdata_fim(implode('-', array_reverse(explode('/', $data))));
    }
    public function getDataInicio(){
      return $this->local->getDataInicio();
    }
    public function getDataFim(){
      return $this->local->getDataFim();
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
    private function salvarCategoria(){
      require_once('../control/Connection.php');
      $conn = Connection::open();
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
      Connection::closeConnection($conn);
      return 1;

    }
    public function salvarResponsavel(Responsavel $r){
      require_once('../control/Connection.php');
      $conn = Connection::open();
      // Inserindo os responsaveis do estabelecimento com fk:
          file_put_contents("salvarResponsaveis.txt", $r->getNome()."\t".$r->getcpf()."\n");
          $result = mysqli_query($conn, "INSERT INTO `responsavel`(`cpf`, `nome`, `telefone`, `cnpj`) VALUES ('".$r->getCpf()."', '".$r->getNome()."', '".$r->getTelefone()."', '".$this->getCnpj()."');");
          if(!$result){
            Connection::closeConnection($conn);
            return 0;
          }
          if($r->getEmail()){
              $result = mysqli_query($conn, "UPDATE `responsavel` SET `email` = '".$r->getEmail()."' WHERE `cpf` = '".$r->getCpf()."';");
          }
      return 1;
    }
    private function salvarHorario(){
      //Inserindo o horário de funcionamento
      $retorno = 0;
      if(!empty($this->horario->getHorarioInicio()) && !empty($this->horario->getHorarioFim)){
        require_once('../control/Connection.php');
        $conn = Connection::open();
        $query = "INSERT INTO `estabelecimento_horario`(`cnpj`, `horario_inicio`, `horario_fim`) VALUES ('$this->cnpj', '$this->horario->getHorarioInicio()', '$this->horario->getHorarioFim()');";
        $retorno = mysqli_query($conn,$query);
        Connection::closeConnection($conn);

      }

      return $retorno;
    }
    private function salvarLocal(){
      //Inserindo o local que esse estabelecimento fica:
      require_once('../control/Connection.php');
      $conn = Connection::open();
      if(!empty($this->local->getSetor()) && !empty($this->local->getSubSetor())  && !empty($this->local->getDataInicio())){
        if(!empty($this->local->getDataFim()))
          $query = "INSERT INTO `estabelecimento_local`(`cnpj`, `setor`, `subsetor`, `data_inicio`, `data_fim`) VALUES ('$this->cnpj','$this->local->getSetor()','$this->local->getSubSetor()','$this->local->getDataInicio()','$this->local->getDataFim()');";
        else
          $query = "INSERT INTO `estabelecimento_local`(`cnpj`, `setor`, `subsetor`, `data_inicio`) VALUES ('$this->cnpj','$this->local->getSetor()','$this->local->getSubSetor()','$this->local->getDataFim()');";
        if(mysqli_query($conn,$query))
        {
          Connection::closeConnection($conn);
          return 1;
        }
        else {
          Connection::closeConnection($conn);
          return 0;
        }
      }
      return 0;
    }
    private function salvarEstabelecimento(){
      require_once('../control/Connection.php');
      $conn = Connection::open();
      $query = "SELECT * FROM `estabelecimento` WHERE `cnpj` = '$this->cnpj';";
      $result = mysqli_query($conn,$query);
      if(!mysqli_fetch_assoc($result))
        mysqli_query($conn, "INSERT INTO `estabelecimento` (`cnpj`, `nome_fantasia`, `razao_social`, `n_funcionario`) VALUES ('$this->cnpj', '$this->nome_fantasia', '$this->razao_social', $this->n_funcionario);");
      else //Update or return 0;
        mysqli_query($conn,"UPDATE `estabelecimento` SET `nome_fantasia`='$this->nome_fantasia',`razao_social`='$this->razao_social', `n_funcionario`=$this->n_funcionario WHERE `cnpj` = '$this->cnpj';");

      if(!empty($this->telefone)){
        $query = "UPDATE `estabelecimento` SET `telefone`= '$this->telefone' WHERE  `cnpj`= '$this->cnpj';";
        mysqli_query($conn, $query);
      }
      if(!empty($this->site))
        mysqli_query($conn, "UPDATE `estabelecimento` SET `site`= '$this->site' WHERE  `cnpj`= '$this->cnpj';");
    }

    public function salvar(){
        $this->salvarEstabelecimento();
        $this->salvarLocal();
        $this->salvarHorario();
        $this->salvarCategoria();
    }
    public function carregar(){
      //Lógica necessária para selecionar
      require_once('../control/Connection.php');
      $conn = Connection::open();
      $query = "SELECT * FROM `estabelecimento` WHERE `cnpj` = '$this->cnpj';";
      $result = mysqli_query($conn,$query);
      Connection::closeConnection($conn);
      if($row = mysqli_fetch_assoc($result)){

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
    public function carregarCategoria(){
      $conn = Connection::open();
      $query = "SELECT estabelecimento_categoria.nome FROM `estabelecimento` INNER JOIN estabelecimento_categoria ON estabelecimento.cnpj = estabelecimento_categoria.cnpj WHERE estabelecimento_categoria.cnpj = '$this->cnpj';";
      $result = mysqli_query($conn,$query);
      Connection::closeConnection($conn);
      while($row = mysqli_fetch_assoc($result)){
          $this->categoria[] = $row['nome'];
      }
    }
    public function carregarHorario(){
      $conn = Connection::open();
      $query = "SELECT horario_inicio, horario_fim FROM estabelecimento_horario WHERE cnpj = '$this->cnpj';";
      $result = mysqli_query($conn,$query);
      Connection::closeConnection($conn);
      if($row = mysqli_fetch_assoc($result)){
        $this->horario->setHorarioInicio($row['horario_inicio']);
        $this->horario->setHorarioFim($row['horario_fim']);
      }
    }
    public function carregarLocal(){
      $conn = Connection::open();
      $query = "SELECT * FROM `estabelecimento_local` WHERE cnpj = '$this->cnpj';";
      $result = mysqli_query($conn,$query);
      Connection::closeConnection($conn);
      if($row = mysqli_fetch_assoc($result)){
          $this->local->setDataInicio($row['data_inicio']);
          $this->local->setDataFim($row['data_fim']);
          $this->local->setSetor($row['setor']);
          $this->local->setSubSetor($row['subsetor']);
      }
    }
  }
