<?php
  if(!empty($_POST))
  {
    if(isset($_POST['cnpj']) && isset($_POST['nome_fantasia']) && isset($_POST['razao_social']))
    {
      require_once('../model/estabelecimento.class.php');
      $estabelecimento = new Estabelecimento($_POST['cnpj'], $_POST['nome_fantasia'], $_POST['razao_social']);
      if(isset($_POST['telefone']))
        $estabelecimento->setTelefone($_POST['telefone']);
      if(isset($_POST['site']))
        $estabelecimento->setSite($_POST['site']);
      // $estabelecimento->salvar();
    }
    else
    {
      // Cai aqui quando deu post incompleto!

    }
  }
?>
