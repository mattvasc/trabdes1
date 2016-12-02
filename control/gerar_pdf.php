<?php
  if(isset($_POST['imprimir'])){
    require_once("../mpdf/mpdf.php");
    $mpdf = new mPDF();
    $mpdf->WriteHTML($_POST['imprimir']);
    $mpdf->Output();
    echo json_encode('1');
  }

?>
