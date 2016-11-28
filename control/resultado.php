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
        <td>123.123.412</td>
        <td> Méc Dolands</td>
        <td> Restaurante da Dona Maria LTDA </td>
        <td> 8 </td>
        <td> <href style="cursor: pointer;"> Editar </href> | <href style="cursor: pointer;"> Desativar </href> | Funcionários </td>
      </tr>
      <tr>
        <td>123123123213</td>
        <td>Smoke shop</td>
        <td> Fumaça LTDA </td>
        <td> 18 </td>
        <td> <href style="cursor: pointer;"> Editar </href> | <href style="cursor: pointer;"> Desativar </href> | Funcionários </td>
      </tr>
    </table>

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
