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
		$date  = date('Y-m-d');
      if ($_POST["tipo"]=="nome_fantasia") {
           $query = "SELECT DISTINCT `estabelecimento`.`cnpj` FROM `estabelecimento` JOIN estabelecimento_local AS temp WHERE (`nome_fantasia` LIKE '%$consulta%') AND (temp.`data_fim` IS NULL OR temp.`data_fim` > '$date');";
      }elseif ($_POST["tipo"]=="cnpj") {
           $query = "SELECT DISTINCT temp.`cnpj` FROM `estabelecimento` JOIN estabelecimento_local AS  temp	 WHERE (temp.`cnpj` = '$consulta') AND (temp.`data_fim` IS NULL OR temp.`data_fim` > '$date');";
      }elseif ($_POST["tipo"]=="razao_social") {
          file_put_contents("razao",$_POST["consulta_dado"]);
          //  $query = "SELECT DISTINCT `temp`.`cnpj` FROM `estabelecimento` JOIN estabelecimento_local AS temp WHERE (temp.`razao_social` LIKE '$consulta%') AND (temp.`data_fim` IS NULL OR temp.`data_fim` > '$date');";
           $query = "SELECT DISTINCT estabelecimento.`cnpj` FROM `estabelecimento`  INNER JOIN estabelecimento_local ON estabelecimento.cnpj = estabelecimento_local.cnpj WHERE (`razao_social` LIKE '%$consulta%') AND (`data_fim` IS NULL OR `data_fim` > '$date')";
      }elseif ($_POST["tipo"]=="categoria") {
           $query = "SELECT DISTINCT estabelecimento_categoria.cnpj FROM `estabelecimento_categoria` INNER JOIN estabelecimento_local ON estabelecimento_categoria.cnpj = estabelecimento_local.cnpj WHERE (`data_fim` IS NULL OR `data_fim` > '$date') AND (0 ";
           $consulta = '';
           foreach($_POST['chkBx'] as $categoria ){
              $query .= " OR (`nome` = '$categoria') ";
              $mini_query = "SELECT COUNT(`nome`) AS `qtd` FROM `estabelecimento_categoria` INNER JOIN estabelecimento_local ON estabelecimento_categoria.cnpj = estabelecimento_local.cnpj WHERE (`data_fim` IS NULL OR `data_fim` > '$date') AND (`nome` = '$categoria')";
              file_put_contents("mini_queries.txt",$mini_query."\n", FILE_APPEND);
              $consulta.= $categoria.',';
              $consulta.= mysqli_fetch_array(mysqli_query($conn,$mini_query))['qtd'].',';
            }
           $query .= ") ;";
      }
      elseif ($_POST["tipo"]=="local") {
            $temp_array = explode(',',$consulta);
           $query = " SELECT `cnpj` FROM `estabelecimento_local` WHERE (`setor` = '$temp_array[0]') AND (`subsetor` = '$temp_array[1]') AND (data_fim IS NULL OR data_fim > '$date');";
      }elseif ($_POST["tipo"]=="horario") {
          $temp_array = explode(',',$consulta);
           $query = "SELECT `cnpj` FROM `estabelecimento_horario` NATURAL JOIN estabelecimento_local WHERE (`horario_inicio` = '".$temp_array[0]."') AND (`horario_fim` = '".$temp_array[1]."') AND (estabelecimento_local.data_fim IS NULL OR estabelecimento_local.data_fim > '$date');";
      }
      elseif($_POST["tipo"]=="categoria-local"){
          $query = "SELECT `cnpj` FROM ( SELECT * FROM `estabelecimento_categoria` NATURAL JOIN `estabelecimento_local`   WHERE (estabelecimento_local.data_fim IS NULL OR estabelecimento_local.data_fim > '$date') AND (0 ";
          $query_contadora = "SELECT COUNT(cnpj) AS numero FROM ( SELECT * FROM `estabelecimento_categoria` NATURAL JOIN `estabelecimento_local`   WHERE (estabelecimento_local.data_fim IS NULL OR estabelecimento_local.data_fim > '$date') AND (0 ";
          $temp = $consulta;
          $consulta = '';

          foreach($_POST['chkBx'] as $categoria ){
             $query .= " OR (`nome` = '$categoria') ";
             $query_contadora .= " OR (`nome` = '$categoria') ";
             $consulta.= $categoria.',';
           }
          $query .= ")) AS `temp` WHERE `temp`.setor = '".$temp."';";
          $query_contadora .= ")) AS `temp` WHERE `temp`.setor = '".$temp."';";
          $consulta = $temp.','.$consulta;
      }
      elseif ($_POST["tipo"]=="todos"){
        $query = " SELECT `cnpj` FROM `estabelecimento_local` WHERE  `data_fim` IS NULL OR `data_fim` > '$date';";
        $consulta = mysqli_fetch_array(mysqli_query($conn,"SELECT MAX(n_funcionario) AS maximo FROM `estabelecimento`;"))['maximo'];
      }
        unlink("query_rodada.txt");
        file_put_contents("query_rodada.txt","Query: ". $query, FILE_APPEND);


            $result = mysqli_query($conn, $query);
            if($result){
                  file_put_contents("72","");
                  $estabelecimento = array();
                  while($row = mysqli_fetch_array($result)){
                      $estabelecimento[] = new Estabelecimento($row['cnpj']);
                    }
                    mysqli_free_result($result);
                  $resultado_final->setEstabelecimento($estabelecimento);
                  $resultado_final->setCampoPesquisado($_POST["tipo"]);
                  $resultado_final->setValorCampo($consulta);
                  if($_POST['tipo']=="categoria-local")
                  {
                    $query_contadora = mysqli_query($conn, $query_contadora);
                    $numero = mysqli_fetch_array($query_contadora)['numero'];
                    $resultado_final->setValorCampo($resultado_final->getValorCampo().','.$numero);

                  }
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
