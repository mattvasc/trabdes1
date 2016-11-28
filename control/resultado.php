<?php

  if(file_exists('../model/resultado.temp'))
  {
    # Criando Tabela:
    ?>
    <table>
      <tr>
        <th>CNPJ</th>
        <th>Nome Fantasia</th>
        <th>Razão Social</th>
        <th>Nº Funcionários</th>
        <th></th>
      </tr>
    <?php
    require_once('../model/resultado.class.php');
    require_once('../model/estabelecimento.class.php');
    $resultado = file_get_contents('../model/resultado.temp');
    $resultado = unserialize($resultado);
    $vetor = $resultado->getEstabelecimento();
    foreach ($vetor as $estabelecimento) {
      # imprime uma linha na tabela

    }
    unlink('../model/resultato.temp');
    # Fechando Tabela
    ?>
    </table>
    <?php
  }
  else{
    ?>
    <br><br>
    <label>
      Nada fora pesquisado!
    </label>
    <?php
  }



 ?>
