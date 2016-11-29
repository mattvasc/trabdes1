<?php
  require_once('Connection.php');
  $conn = Connection::open();
  $query = "SELECT * FROM `horario`;";
  $result = mysqli_query($conn,$query);
  $horario = array();
  while($row = mysqli_fetch_assoc($result)){
      $horario[] = $row['horario_inicio'].','.$row['horario_fim'];
  }
  Connection::closeConnection($conn);
?>
