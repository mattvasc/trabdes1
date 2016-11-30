<?php
// Verifica se foi feita alguma busca
// Caso contrario, redireciona o visitante pra home
if (empty($_POST) || !isset($_POST['tipo'])) {
  ?>
    <html><script type="text/javascript">window.location.href="../index.php";</script></html>
  <?php
}
      require_once("../model/resultado.class.php");
      require_once("../model/estabelecimento.class.php");
      require_once('Connection.php');


      $consulta = $_POST["consulta_dado"];
      $conn = Connection::open();
      $resultado_final = new Resultado();

        // descobre o cnpj, se nao for o item da busca
      if ($_POST["tipo"]=="nome_fantasia") {
           $query = " SELECT `cnpj` FROM `estabelecimento` WHERE (`nome_fantasia` LIKE '%$consulta%'); ";
      }elseif ($_POST["tipo"]=="cnpj") {
           $query = " SELECT `cnpj` FROM `estabelecimento` WHERE (`cnpj` = $consulta); ";
      }elseif ($_POST["tipo"]=="razao_social") {
           $query = " SELECT `cnpj` FROM `estabelecimento` WHERE (`razao_social` LIKE '%$consulta%'); ";
      }elseif ($_POST["tipo"]=="categoria") {
           $query = " SELECT `cnpj` FROM `estabelecimento_categoria` WHERE 0 ";
           $
           $consulta = '';
           foreach($_POST['chkBx'] as $categoria ){
              $query .= " OR (`nome` = '$categoria') ";
              $consulta.= $categoria.',';
            }
           $query .= " ;";
      }
      elseif ($_POST["tipo"]=="local") {
            $temp_array = explode(',',$consulta);
           $query = "SELECT `cnpj` FROM `estabelecimento_local` WHERE (`setor` LIKE '".$temp_array[0]."') AND (`subsetor` LIKE '".$temp_array[1]."');";
      }elseif ($_POST["tipo"]=="horario") {
          $temp_array = explode(',',$consulta);
           $query = " SELECT `cnpj` FROM `estabelecimento_horario` WHERE (`horario_inicio` = '".$temp_array[0]."') AND (`horario_fim` = '".$temp_array[1]."'); ";
      }
      elseif($_POST["tipo"]=="categoria-local"){
          $query = "SELECT `cnpj` FROM ( SELECT * FROM `estabelecimento_categoria` NATURAL JOIN `estabelecimento_local`   WHERE 0 ";
          $temp_array = explode(',',$consulta);
          $consulta = '';
          foreach($_POST['chkBx'] as $categoria ){
             $query .= " OR (`nome` = '$categoria') ";
             $consulta.= $categoria.',';
           }
          $query .= ") AS `temp` WHERE `temp`.setor = '".$temp_array[0]."' AND `temp`.subsetor = '".$temp_array[1]."' ;";
          $consulta = $temp_array[0].','.$temp_array[1].','.$consulta;

      }
      elseif ($_POST["tipo"]=="todos"){
        $query = " SELECT `cnpj` FROM `estabelecimento`; ";
      }
        unlink("query_rodada.txt");
        file_put_contents("query_rodada.txt","Query: ". $query, FILE_APPEND);
        file_put_contents("query_rodada.txt","consulta_dado: ".$consulta, FILE_APPEND);


            $result = mysqli_query($conn, $query);
            if($result){
                  $estabelecimento = array();
                  while($row = mysqli_fetch_array($result)){
                      $estabelecimento[] = new Estabelecimento($row['cnpj']);
                    }
                    mysqli_free_result($result);
                  $resultado_final->setEstabelecimento($estabelecimento);
                  $resultado_final->setCampoPesquisado($_POST["tipo"]);
                  $resultado_final->setValorCampo($consulta);
                  file_put_contents("query_rodada.txt","do OBJ: ".$consulta, FILE_APPEND);
                  unlink('../model/resultado.temp');
                  file_put_contents('../model/resultado.temp', serialize($resultado_final));

                  Connection::closeConnection($conn);

            }

?>
<html>
  <script type="text/Javascript">
     window.location.href = '../view/resultado.php';
  </script>
</html>
