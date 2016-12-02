<?php
  require_once('Connection.php');
  $conn = Connection::open();
  // $query = "SELECT `subsetor` FROM `local` WHERE setor = '" . $_POST['Setor'] . "' ORDER BY subsetor" ; << todos os susbetores
  if($_POST['busca_limpa']==1) // Cadastra
    $query = "SELECT local.subsetor FROM `local` LEFT JOIN `estabelecimento_local` ON local.setor=estabelecimento_local.setor AND local.subsetor = estabelecimento_local.subsetor WHERE  local.setor = '". $_POST['Setor'] ."' AND(estabelecimento_local.cnpj IS NULL OR estabelecimento_local.data_fim < CURDATE()) ORDER BY local.subsetor";
  else if($_POST['busca_limpa']==0){ // Busca
    $query = "SELECT local.subsetor FROM `local` LEFT JOIN `estabelecimento_local` ON local.setor=estabelecimento_local.setor AND local.subsetor = estabelecimento_local.subsetor WHERE  local.setor = '". $_POST['Setor'] ."' ORDER BY local.subsetor;";
  }
  else if($_POST['busca_limpa']==2) // editar
  {
    $query = "SELECT local.subsetor FROM `local` LEFT JOIN `estabelecimento_local` ON local.setor=estabelecimento_local.setor AND local.subsetor = estabelecimento_local.subsetor WHERE  local.setor = '".$_POST['Setor']."' AND(estabelecimento_local.cnpj IS NULL OR estabelecimento_local.cnpj = '".$_POST['cnpj']."' OR  estabelecimento_local.data_fim < CURDATE()) ORDER BY local.subsetor";
    file_put_contents("query_rodada2.txt",$query);
  }
    if ($result = mysqli_query($conn, $query)) {

    $SubSetores = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $SubSetores[] = $row['subsetor'];
    }
    echo json_encode($SubSetores);
  };

  mysqli_free_result($result);
    Connection::closeConnection($conn);

?>
