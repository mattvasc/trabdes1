<?php

  if(file_exists('../model/resultado.temp'))
  {
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
  Data da pesquisa: <?php date_default_timezone_set('America/Sao_Paulo'); echo date("d/m/Y");?>.<br> Busca por CNPJ: <br> 123.XXX.XXX-XXXX-XX
    <table border="1">
      <tr>
        <th>CNPJ</th>
        <th>Nome Fantasia</th>
        <th>Razão Social</th>
        <th>Nº Funcionários</th>
        <th>Ação</th>
      </tr>
      <tr>
        <td class="cnpj-mask" id='cnpj_1'>95446425000135</td>
        <td> Méc Dolands</td>
        <td> Restaurante da Dona Maria LTDA </td>
        <td> 8 </td>
        <td> <href style="cursor: pointer;" onclick="window.location.href = './editar.php?cnpj='+$('#cnpj_1').cleanVal();"> Editar </href> | <href style="cursor: pointer;" onclick="desativar(95078178000161)"> Desativar </href> | <msv style="cursor: pointer;" onclick="window.location.href = './funcionarios.php?cnpj='+$('#cnpj_1').cleanVal();">Funcionários</msv> </td>
      </tr>
      <tr>
        <td>123123123213</td>
        <td>Smoke shop</td>
        <td> Fumaça LTDA </td>
        <td> 18 </td>
        <td> <href style="cursor: pointer;"> Editar </href> | <href style="cursor: pointer;"> Desativar </href> | Funcionários </td>
      </tr>
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
    rename("../model/resultado.temp","../model/resultado.temp.bkp");
    // # Fechando Tabela
    ?>
    <br><br>
    <center>
    <input type="button" value="Gerar Relatório">
  </center>
    <?php
  }
  else{
    rename("../model/resultado.temp.bkp","../model/resultado.temp");

    ?>
    <br><br><center>
    <label>
      Nada fora pesquisado!
    </label></center>
    <?php
  }



 ?>
