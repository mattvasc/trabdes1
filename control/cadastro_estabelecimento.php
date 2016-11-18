<?php
  require_once('Connection.php');
  $conn = Connection::open();
  $query = "SELECT `setor` FROM `local` GROUP BY `setor` ORDER BY `setor`" ;

    if ($result = mysqli_query($conn, $query)) {
    ?>
    <script type="text/javascript">
      window.onload = function () {
      var select = document.getElementById("setor");
      var option;
    <?php
    while ($row = mysqli_fetch_assoc($result)) { ?>

        option = document.createElement('option');
        option.text = option.value = '<?php echo $row["setor"];?>';
        select.add(option, select.length);
      <?php
    }
  ?>
};

</script>
<?php
}
mysqli_free_result($result);
  $query = "SELECT `subsetor` FROM `local` GROUP BY `setor` ORDER BY `subsetor`" ;
/*
  if(!empty($_POST))
  {
    if(isset($_POST['cnpj']) && isset($_POST['nome_fantasia']) && isset($_POST['razao_social']))
    {
      require_once('../model/estabelecimento.class.php');
      $estabelecimento = new Estabelecimento($_POST['cnpj'], $_POST['nome_fantasia'], $_POST['razao_social']);
      if(isset($_POST['telefone']))
        $estabelecimento->setTelefone($_POST['telefone']);
      if(isset($_POST['site']))
        $estabelecimento->setSite($_POST['site']);
      // $estabelecimento->salvar();
    }
    else
    {
      // Cai aqui quando deu post incompleto!

    }
  }*/
?>
