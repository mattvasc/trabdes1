<?php
  if(isset($_POST['cnpj']))
  {
      require_once('Connection.php');
      $conn = Connection::open();

      $date  = date('Y-m-d');
      $query = "UPDATE `estabelecimento_local` SET `data_fim`='$date' WHERE data_fim is NULL AND `cnpj`='".$_POST['cnpj']."';";
      $result =  mysqli_query($conn, $query);
      if(mysqli_fetch_assoc($result))
        echo json_encode("1");
      else
        echo json_encode("0");

      mysqli_free_result($result);
      Connection::closeConnection($conn);
  }
?>
