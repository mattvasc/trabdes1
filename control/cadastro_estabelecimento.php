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
        checkbox.name = "chkBx[]";
        checkbox.value = "<?php echo $row['nome'];?>";
        checkbox.id = checkbox.value;

        label = document.createElement('label')
        label.htmlFor = checkbox.value;
        label.appendChild(document.createTextNode('<?php echo $row['nome'];?>'));
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
  $query = "SELECT * FROM `horario`;";
  $result = mysqli_query($conn,$query);
  ?> var select = document.getElementById("horario");
  <?php
  while($row = mysqli_fetch_assoc($result)){
    ?>
        option = document.createElement('option');
        option.value = "<?php echo $row['horario_inicio'].','.$row['horario_fim'];?>";
        <?php
        if($row['horario_inicio']!='00:00:00' || $row['horario_fim']!='23:59:59'){ ?>
          option.text = "<?php echo substr($row['horario_inicio'],0,5)." - ".substr($row['horario_fim'],0,5);?>";
        <?php
      } else{
        ?>
        option.text = "24 horas";
        <?php
      } ?>
        select.add(option, select.length);

    <?php
  }
  Connection::closeConnection($conn);
    ?>
    };
  </script>
<?php
if(!empty($_POST))
{
  require_once("../model/estabelecimento.class.php");
  if(isset($_POST['cnpj'], $_POST['razao_social'], $_POST['nome_fantasia'], $_POST['setor'], $_POST['subsetor'], $_POST['chkBx'], $_POST['data_inicio'], $_POST['horario']))
  {
    $estabelecimento = new Estabelecimento($_POST['cnpj'], $_POST['nome_fantasia'], $_POST['razao_social'], $_POST['setor'], $_POST['subsetor'], $_POST['data_inicio'], $_POST['horario']);
    foreach($_POST['chkBx'] as $categoria ){
      $estabelecimento->addCategoria($categoria);
    }
    if(isset($_POST['site']) && !empty($_POST['site']))
      $estabelecimento->setSite($_POST['site']);
    if(isset($_POST['telefone']) && !empty($_POST['telefone']))
      $estabelecimento->setTelefone($_POST['telefone']);
    if(isset($_POST['data_fim'])&& !empty($_POST['data_fim']))
      $estabelecimento->setDataFim($_POST['data_fim']);
    if(isset($_POST['n_funcionario']) && !empty($_POST['n_funcionario'])){
      $estabelecimento->setNFuncionario($_POST['n_funcionario']);
    }

    file_put_contents('../model/estabelecimento.temp', serialize($estabelecimento));
    $estabelecimento->salvar();
	if($_POST['prox']=='salvar'){// ir para cadastro_responsavel com cnpj via $_POST;

    ?>
      <script type="text/Javascript">
        window.location.href = 'cadastro_responsavel.php';
      </script>
    <?php
	}
	else if($_POST['prox'] == 'alterar'){

	 ?>
      <script type="text/Javascript">
        window.location.href = '../index.php';
      </script>
    <?php
	}


  }
  else {
    echo "Houve um erro ao requesitar sua solicitação! Revise todos os campos e tente novamente.";

  }
}
