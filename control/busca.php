<?php
// Verifica se foi feita alguma busca
// Caso contrario, redireciona o visitante pra home
// if (!isset($_POST['consulta'])) {
//   header("Location: /");
//   exit;
// }
      require_once("../model/resultado.class.php");
      require_once("../model/estabelecimento.class.php");
      require_once('Connection.php');


      $consulta = $_POST["consulta"];
      $conn = Connection::open();
      $resultado_final = new Resultado();

        // descobre o cnpj, se nao for o item da busca
      if ($_POST["tipo"]=="fantasia") {
           $query = " SELECT * FROM `estabelecimento` WHERE (`nome_fantasia` LIKE '$consulta') ";
      }elseif ($_POST["tipo"]=="cnpj") {
           $query = " SELECT * FROM `estabelecimento` WHERE (`cnpj` = $consulta) ";
      }elseif ($_POST["tipo"]=="razao") {
           $query = " SELECT * FROM `estabelecimento` WHERE (`razao_social` LIKE '$consulta') ";
      }elseif ($_POST["tipo"]=="categoria") {
           $query = " SELECT * FROM `estabelecimento_categoria` WHERE (`nome` LIKE '$consulta') ";
      }elseif ($_POST["tipo"]=="local") {
           $query = " SELECT * FROM `estabelecimento_local` WHERE (`setor` LIKE '$consulta') ";
      }



            $result = mysqli_query($conn, $query);
            if($result){
                  $row = mysqli_fetch_array($result);
                  $consulta = $row['cnpj'];
                  $arrayteste = array($row['cnpj']);
                  while($row = mysqli_fetch_array($result)){
                          $arrayteste[] = $row['cnpj'];
                    }
                    mysqli_free_result($result);

                  $i=0;
                  while(count($arrayteste)>$i){

                          $consulta= $arrayteste[$i];
                          echo $query = "SELECT * FROM `estabelecimento`, `responsavel`,`estabelecimento_horario`,`estabelecimento_local`WHERE (`estabelecimento`.`cnpj` = $consulta AND `responsavel`.`cnpj` = $consulta AND `estabelecimento_horario`.`cnpj` = $consulta AND `estabelecimento_local`.`cnpj` = '$consulta' AND `responsavel`.`cnpj` = '$consulta' AND `responsavel`.`cnpj` = '$consulta') ";
                          $teste = mysqli_query($conn, $query);
                          if($teste){
                          $resultadoQuery = mysqli_fetch_array($teste);

                          $estabelecimento = new Estabelecimento();
                          $estabelecimento->setTelefone($resultadoQuery['telefone']);
                          $estabelecimento->setCnpj($resultadoQuery['cnpj']);
                          $estabelecimento->setNomeFantasia($resultadoQuery['nome_fantasia']);
                          $estabelecimento->setRazaoSocial($resultadoQuery['razao_social']);
                          $estabelecimento->setSite($resultadoQuery['site']);
                          $estabelecimento->setSetor($resultadoQuery['setor']);
                          $estabelecimento->setSubsetor($resultadoQuery['subsetor']);
                          $estabelecimento->setDataInicio($resultadoQuery['data_inicio']);
                          $estabelecimento->setDataFim($resultadoQuery['data_fim']);
                          $estabelecimento->sethorarioInicio($resultadoQuery['horario_inicio']);
                          $estabelecimento->setHorarioFim($resultadoQuery['horario_fim']);
                          $estabelecimento->setNFuncionario($resultadoQuery['n_funcionario']);

                          $resultado_final->addEstabelecimento($estabelecimento);
                          $i++;
                        }
                  }
                  $resultado_final->setCampoPesquisado($_POST["tipo"]);
                  $resultado_final->setValorCampo($_POST["consulta"]);


                  // echo "<br>";    echo "<br>";
                  // echo "FINAL";
                  // var_dump($resultado_final);
                  // echo "<br>";    echo "<br>";
                  // echo "<br>";    echo "<br>";

                  file_put_contents('../model/resultado.temp', serialize($resultado_final));

                  Connection::closeConnection($conn);

            }

?>

<script type="text/Javascript">
  // window.location.href = '../view/resultado.php';
</script> -->


<!--<script type="text/Javascript">
  window.location.href = 'resultado.php';
</script> -->
