<?php
  require_once('Connection.php');
  $conn = Connection::open();
  $vet = array();
  $query = "SELECT `nome` FROM `categoria`;";
  if ($result = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
      $vet[] = $row['nome'];
    }
  }
  Connection::closeConnection($conn);
  echo json_encode($vet);
?>
