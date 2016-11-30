<?php

  if(file_exists('../model/resultado.temp'))
  {
    require_once('../model/resultado.class.php');
    require_once('../model/estabelecimento.class.php');

    $resultado = file_get_contents('../model/resultado.temp');
    $resultado = unserialize($resultado);
    // # Criando Tabela:
    ?><center>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
  Data da pesquisa: <?php date_default_timezone_set('America/Sao_Paulo'); echo date("d/m/Y");?>.<br> Busca por
  <?php
    switch ($resultado->getCampoPesquisado()) {
      case 'nome_fantasia':
        echo 'Nome Fantasia: '.(string)$resultado->getValorCampo();
        break;
        case 'todos':
          echo 'Todos os estabelecimento';
        break;
        case 'horario':
          echo 'Horário de Funcionamento: '.$resultado->getValorCampo();
        break;
        case 'local':
          echo 'Local: '.$resultado->getValorCampo();
        break;
        case 'razao_social':
          echo 'Razão Social: '.$resultado->getValorCampo();
        break;
        case 'cnpj':
          echo 'CNPJ: ' . $resultado->getValorCampo();
        break;
        case 'categoria':
          echo 'Categorias: ' . $resultado->getValorCampo();
        break;
      default:
        echo "alguma coisa não cadastrada no switch";
      break;
    };

  ?>




  <br>
    <table border="1">
      <tr>
        <th>CNPJ</th>
        <th>Nome Fantasia</th>
        <th>Razão Social</th>
        <th>Nº Func.</th>
        <th>Ação</th>
      </tr>

      <?php
      /*
      <tr>
        <td class="cnpj-mask" id='cnpj_1'>95446425000135</td>
        <td> Méc Dolands</td>
        <td> Restaurante da Dona Maria LTDA </td>
        <td> 8 </td>
        <td> <href style="cursor: pointer;" onclick="window.location.href = './editar.php?cnpj='+$('#cnpj_1').cleanVal();"> Editar </href> | <href style="cursor: pointer;" onclick="desativar(95078178000161)"> Desativar </href> | <msv style="cursor: pointer;" onclick="window.location.href = './funcionarios.php?cnpj='+$('#cnpj_1').cleanVal();">Funcionários</msv> </td>
      </tr>
      */
          $temp = $resultado->getEstabelecimento();
          // file_put_contents("resultado_busca.txt",print_r($temp));
          $count = 0;
          foreach($temp as $t){
            $t->carregar();
            $t->carregarCategoria();
            $t->carregarHorario();
            $t->carregarLocal();
            ?>
            <tr>
              <td class="cnpj-mask" id='cnpj_<?php echo $count;?>'><?php echo $t->getCnpj(); ?></td>
              <td> <?php echo $t->getNomeFantasia(); ?></td>
              <td> <?php echo $t->getRazaoSocial();?></td>
              <td> <?php echo $t->getNFuncionario();?> </td>
              <td> <href style="cursor: pointer;" onclick="window.location.href = './editar.php?cnpj='+$('#cnpj_<?php echo $count;?>').cleanVal();"> Editar </href> | <href style="cursor: pointer;" onclick="desativar(95078178000161)"> Desativar </href> | <msv style="cursor: pointer;" onclick="window.location.href = './funcionarios.php?cnpj='+$('#cnpj_1').cleanVal();">Funcionários</msv> </td>
            </tr>
            <?
            $count++;
          }
      ?>
    </table>
    <script>
    $(document).ready(function(){
      $('.cnpj-mask').mask('00.000.000/0000-00', {reverse: false});
    });
    function desativar(cnpj){
      var r = confirm("Tem certeza de que gostaria de desativar o estabelecimento de CPNJ: "+cnpj+"?");
      if (r) {
         $.ajax({
          url: '../control/apagar.php',
          type: "POST",
          data: {cnpj:cnpj},
          success: function (result) {
          // you will get response from your php page (what you echo or print)
          }
        });
      }
    }
    </script>
    </center>
    <?php
    /*
    require_once('../model/resultado.class.php');
    require_once('../model/estabelecimento.class.php');
    $resultado = file_get_contents('../model/resultado.temp');
    $resultado = unserialize($resultado);
    $vetor = $resultado->getEstabelecimento();
    foreach ($vetor as $estabelecimento) {
      # imprime uma linha na tabela

    }
    unlink('../model/resultato.temp');*/
    // rename("../model/resultado.temp","../model/resultado.temp.bkp");
    // # Fechando Tabela
    ?>
    <br><br>
    <center>
    <input type="button" value="Gerar Relatório">
  </center>
    <?php
  }
  else{

    ?>
    <br><br><center>
    <label>
      Nada fora pesquisado!
    </label></center>
    <?php
  }



 ?>
