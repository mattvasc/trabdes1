<?php

require_once('Connection.php');
$conn = Connection::open();
$query = "SELECT `subsetor` FROM `local` WHERE setor = '" . $_POST['Setor'] . "' ORDER BY subsetor" ;

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
