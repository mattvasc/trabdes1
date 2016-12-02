<?php
  require_once('Connection.php');
  $conn = Connection::open();
  $query = "SELECT `setor` FROM `local` GROUP BY `setor` ORDER BY `setor`" ;
  $vetor = array();
  if ($result = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $vetor[] = $row["setor"];
      }
  }
  echo json_encode($vetor);

?>
