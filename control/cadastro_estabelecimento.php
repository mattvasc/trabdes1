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
  mysqli_close($conn);
?>
