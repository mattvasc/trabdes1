<?php
  require_once('Connection.php');
  $conn = Connection::open();
  ?>
  <script type="text/javascript">
      window.onload = function () {
  <?php
  $query = "SELECT `setor` FROM `local` GROUP BY `setor` ORDER BY `setor`" ;

    if ($result = mysqli_query($conn, $query)) {
    ?>

    var select = document.getElementById("setor");
    var option;
  <?php
  while ($row = mysqli_fetch_assoc($result)) { ?>

      option = document.createElement('option');
      option.text = option.value = '<?php echo $row["setor"];?>';
      select.add(option, select.length);
    <?php
  }

}
  mysqli_free_result($result);
  $query = "SELECT `nome` FROM `categoria`;";
  if ($result = mysqli_query($conn, $query)) {?>
    var container  = document.getElementById("categoria_tbl");
    var checkbox;
    var label;
    var row; var column;
    <?php
      $i = 0;
      while ($row = mysqli_fetch_assoc($result)) {
         ?>
        checkbox = document.createElement('input');
        checkbox.type = "checkbox";
        checkbox.name = "chkBx";
        checkbox.value = "<?php echo $row['nome'];?>";
        checkbox.id = checkbox.value;

        label = document.createElement('label')
        label.htmlFor = checkbox.value;
        label.appendChild(document.createTextNode('<?php echo utf8_encode($row['nome']);?>'));
        <?php if($i%2==0) {
        ?>
          row = document.createElement('div');
          row.class = ('form-row');
        <?php
        }
      ?>
        column = document.createElement('div');
        column.class = ('form-column');
        column.appendChild(checkbox);
        column.appendChild(label);
        row.appendChild(column);

        <?php
        if($i%2==1){
            ?>
            container.appendChild(row);
            <?php
        }?>
        <?php
        $i++;
      }
      if($i%2==1){
          ?>
          container.appendChild(row);
          <?php
        $i=0;
      }

  }
  Connection::closeConnection($conn);
    ?>
    /*$('input[type="checkbox"][name="chkBx"]').on('change',function(){
      var getArrVal = $('input[type="checkbox"][name="chkBx"]:checked').map(function(){
        return this.value;
      }).toArray();
      if(getArrVal.length){
      //execute the code
      $('#cont').html(getArrVal.toString());
      } else {
        $(this).prop("checked",true);
        return false;
      };
    });*/
    };
  </script>
<?php
