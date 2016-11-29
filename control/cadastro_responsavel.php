<?php
if(!empty($_POST))
{
  require_once("../model/responsavel.class.php");
//  print_r($_POST);
  if(isset($_POST['cpf'], $_POST['nome'], $_POST['telefone'], $_POST['acao'])){
    $responsavel = new Responsavel($_POST['cpf'], $_POST['nome'], $_POST['telefone']);
    if(isset($_POST['email']) && !empty($_POST['email']))
      $responsavel->setEmail($_POST['email']);
    $estabelecimento->addResponsavel($responsavel);
    $temp = $estabelecimento->getResponsavel();
    foreach ($temp as $t) {
      file_put_contents("vetor_Resp.txt", $t->getNome()."\t".$t->getcpf()."\n", FILE_APPEND);
    }
    if($_POST['acao'] == 'salvar'){
      unlink('../model/estabelecimento.temp');
      /*salvar responsáveis*/
      if($estabelecimento->salvarResponsavel()){
        ?>
        <script>
        alert("Salvo com sucesso!");
        window.location.href="../index.php";
        </script>
        <?php
      }
    }
  }else{
    echo "Houve um erro ao requesitar sua solicitação! Revise todos os campos e tente novamente.";
  }
}?>
