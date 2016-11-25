<?php
if(!empty($_POST) && isset($_POST['estabelecimento']))
{
  require_once("../model/responsavel.class.php");
  if(isset($_POST['cpf_sem_mascara'], $_POST['nome'], $_POST['telefone'], $_POST['acao'])){
    $responsavel = new Responsavel($_POST['cpf'], $_POST['nome'], $_POST['telefone']);
    if(isset($_POST['email']) && !empty($_POST['email']))
      $responsavel->setEmail($_POST['email']);

    //$responsavel->salvar();
    $_POST['estabelecimento']->addResponsavel($responsavel);
    if($_POST['acao'] == 'salvar'){
      /*salvar responsáveis*/
      $_POST['estabelecimento']->salvarResponsavel();
      ?>
      <script>
        alert("Salvo com sucesso!");
      </script>
      <?php
    }
  }else{
    echo "Houve um erro ao requesitar sua solicitação! Revise todos os campos e tente novamente.";
  }
?>
