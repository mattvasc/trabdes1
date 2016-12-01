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
           $query = "SELECT DISTINCT `estabelecimento`.`cnpj` FROM `estabelecimento` JOIN estabelecimento_local AS temp WHERE (`nome_fantasia` LIKE '$consulta%') AND (temp.`data_fim` IS NULL OR temp.`data_fim` > '$date');";
      }elseif ($_POST["tipo"]=="cnpj") {
           $query = "SELECT DISTINCT temp.`cnpj` FROM `estabelecimento` JOIN estabelecimento_local AS  temp	 WHERE (temp.`cnpj` = '$consulta') AND (temp.`data_fim` IS NULL OR temp.`data_fim` > '$date');";
      }elseif ($_POST["tipo"]=="razao_social") {
           $query = "SELECT DISTINCT `temp`.`cnpj` FROM `estabelecimento` JOIN estabelecimento_local AS temp WHERE (temp.`razao_social` LIKE '$consulta%') AND (temp.`data_fim` IS NULL OR temp.`data_fim` > '$date');";
      }elseif ($_POST["tipo"]=="categoria") {
           $query = "SELECT estabelecimento_categoria.cnpj FROM `estabelecimento_categoria` INNER JOIN estabelecimento_local ON estabelecimento_categoria.cnpj = estabelecimento_local.cnpj WHERE (`data_fim` IS NULL OR `data_fim` > '$date') AND (0 ";
           $
           $consulta = '';
           foreach($_POST['chkBx'] as $categoria ){
              $query .= " OR (`nome` = '$categoria') ";
              $consulta.= $categoria.',';
            }
           $query .= ") ;";
      }
      elseif ($_POST["tipo"]=="local") {
            $temp_array = explode(',',$consulta);
           $query = " SELECT `cnpj` FROM `estabelecimento_local` WHERE (`setor` = '$temp_array[0]') AND (`subsetor` = '$temp_array[1]') AND (data_fim IS NULL OR data_fim > '$date');";
      }elseif ($_POST["tipo"]=="horario") {
          $temp_array = explode(',',$consulta);
           $query = "SELECT `cnpj` FROM `estabelecimento_horario` NATURAL JOIN estabelecimento_local WHERE (`horario_inicio` = '".$temp_array[0]."') AND (`horario_fim` = '".$temp_array[1]."') AND (estabecimento_local.data_fim IS NULL OR estabelecimento_local.data_fim > '$date');";
      }
      elseif($_POST["tipo"]=="categoria-local"){
		  /*SELECT estabelecimento_categoria.`cnpj` FROM `estabelecimento_categoria` INNER JOIN `estabelecimento_local` ON estabelecimento_categoria.cnpj = estabelecimento_local.cnpj WHERE (estabelecimento_local.data_fim IS NULL OR estabelecimento_local.data_fim > '2016-12-01') AND (0  OR (`nome` = 'Transporte de Carga') ) AND setor = 'Terminal 5' AND subsetor = 'lol'*/
          $query = "SELECT `cnpj` FROM ( SELECT * FROM `estabelecimento_categoria` NATURAL JOIN `estabelecimento_local`   WHERE (estabecimento_local.data_fim IS NULL OR estabelecimento_local.data_fim > '$date') AND (0 ";
          $temp_array = explode(',',$consulta);
          $consulta = '';
          foreach($_POST['chkBx'] as $categoria ){
             $query .= " OR (`nome` = '$categoria') ";
             $consulta.= $categoria.',';
           }
          $query .= ")) AS `temp` WHERE `temp`.setor = '".$temp_array[0]."' AND `temp`.subsetor = '".$temp_array[1]."' ;";
          $consulta = $temp_array[0].','.$temp_array[1].','.$consulta;
      }
      elseif ($_POST["tipo"]=="todos"){
        $query = " SELECT `cnpj` FROM `estabelecimento_local` WHERE  `data_fim` IS NULL OR `data_fim` > '$date';";
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
