<?php
  require('WriteHTML.php');

  if(file_exists('../model/resultado.temp'))
  {
    require_once('../model/resultado.class.php');
    require_once('../model/estabelecimento.class.php');

    $resultado = file_get_contents('../model/resultado.temp');
    $resultado = unserialize($resultado);
    // # Criando Tabela:
    $text = '<html>
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
    <br>
      <table border="1">
        <tr>
          <th>CNPJ</th>
          <th>Nome Fantasia</th>
          <th>Razão Social</th>
          <th>Nº Func.</th>
        </tr>';


        $pdf=new PDF_HTML();

        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(true, 15);

        $pdf->AddPage();
        $pdf->SetFont('Arial','B',11);

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
        case 'categoria-local':
          $temp = explode(',',$resultado->getValorCampo());
          echo 'Local: '.$temp[0].' - '.$temp[1].".<br> Categoria(s): ";
          for($i=2;$i < count($temp);$i++){
            echo $temp[$i].' ';
          }
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
          $count = 0;
          foreach($temp as $t){
            $t->carregar();
            $t->carregarCategoria();
            $t->carregarHorario();
            $t->carregarLocal();
            $cnpj =  $t->getCnpj();
            $fantasia =  $t->getNomeFantasia();
            $razao = $t->getRazaoSocial();
            $nfunc = $t->getNFuncionario();
            ?>
            <tr>
              <td class="cnpj-mask" id='cnpj_<?php echo $count;?>'><?php echo $t->getCnpj(); ?></td>
              <td> <?php echo $t->getNomeFantasia(); ?></td>
              <td> <?php echo $t->getRazaoSocial();?></td>
              <td> <?php echo $t->getNFuncionario();?> </td>
              <td> <href style="cursor: pointer;" onclick="window.location.href = './editar.php?cnpj='+$('#cnpj_<?php echo $count;?>').cleanVal();"> Editar </href> | <href style="cursor: pointer;" onclick="desativar(95078178000161)"> Desativar </href> | <msv style="cursor: pointer;" onclick="window.location.href = './funcionarios.php?cnpj='+$('#cnpj_1').cleanVal();">Funcionários</msv> </td>
            </tr>
            <?
            $text .= '<tr>
              <td class="cnpj-mask" id='cnpj_'.$count.''>'.$cnpj.'</td>
              <td> '.$fantasia.'</td>
              <td>'.$razao.'</td>
              <td>'.$nfunc.'</td>
            </tr>';
            $count++;
          }
          $text .=  '</table>
                    </html>';
          file_put_contents("textpdf.txt",$text);

          $pdf->WriteHTML("$text");
          $pdf->Output('D','relatorio.pdf');
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
            result = JSON.parse(result);
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
