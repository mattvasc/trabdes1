<?php
if(!empty($_POST))
{
  require_once("../model/responsavel.class.php");
  if(isset($_POST['cpf'], $_POST['nome'], $_POST['telefone'])){
    $responsavel = new Responsavel($_POST['cpf'], $_POST['nome'], $_POST['telefone']);
    if(isset($_POST['email']))
      $responsavel->setEmail($_POST['email']);
    $estabelecimento->addResponsavel($responsavel);

      if($estabelecimento->salvarResponsavel($responsavel)){
        ?>
        <script>
        window.location.href="#";
        </script>
        <?php
      }
  }else{
    echo "Houve um erro ao requesitar sua solicitação! Revise todos os campos e tente novamente.";
  }
}?>
