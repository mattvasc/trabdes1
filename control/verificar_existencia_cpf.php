<?php
  if(isset($_POST['cpf']) && isset($_POST['estabelecimento']))
  {
    require_once('Connection.php');
    $conn = Connection::open();
    $query = "SELECT * FROM `estabelecimento` NATURAL JOIN 'responsavel' WHERE 'cnpj' = '"+ .$_POST['estabelecimento']->getCnpj();."';";
    $result = mysqli_query($conn, $query);
    if(mysqli_fetch_assoc($result))
      echo json_encode("1");
    else
      echo json_encode("0");

    mysqli_free_result($result);
    Connection::closeConnection($conn);
  }
?>
