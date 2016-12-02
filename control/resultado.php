<?php

  if(file_exists('../model/resultado.temp'))
  {
    require_once('../model/resultado.class.php');
    require_once('../model/estabelecimento.class.php');

    $resultado = file_get_contents('../model/resultado.temp');
    $resultado = unserialize($resultado);
    // # Criando Tabela:
    ?><center>

	  Data da pesquisa: <?php date_default_timezone_set('America/Sao_Paulo'); echo date("d/m/Y - h:i");?>.<br> Busca por <b>
	  <?php
    switch ($resultado->getCampoPesquisado()) {
      case 'nome_fantasia':
        echo 'Nome Fantasia: '.(string)$resultado->getValorCampo();
        break;
        case 'todos':
          echo 'Todos os estabelecimentos.<br>';
          echo 'Maior número de fúncionários: '.$resultado->getValorCampo();
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
          echo 'Categorias. Quantidade por categoria: ';
          $temp = explode(',',$resultado->getValorCampo());
          for($i=0; $i<count($temp)-1;$i+=2){
            echo "<br>".$temp[$i]." - ". $temp[$i+1];
          }
        break;
        case 'categoria-local':
          $temp = explode(',',$resultado->getValorCampo());
          echo 'Local: '.$temp[0].".<br> Categoria(s): ";
          for($i=1;$i < count($temp)-1;$i++){
            echo $temp[$i].' ';
          }
          echo "<br>Estabelecimentos encontrados: ". $temp[count($temp)-1];
        break;
      default:
        echo "alguma coisa não cadastrada no switch";
      break;
    }

  ?>
</b>



  <br>
    <table border="1">
      <tr>
        <th>CNPJ</th>
        <th>Nome Fantasia</th>
        <th>Razão Social</th>
        <th>Nº Func.</th>
        <th> Horário </th>
        <th> Setor </th>
        <th> Subsetor </th>
        <th class="acao" >Ação</th>
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
          if(!empty($temp)){
          foreach($temp as $t):
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
              <td> <?php echo ($t->getHorarioInicio()=='00:00:00' && $t->getHorarioFim()=='23:59:59')?'24 Horas':substr($t->getHorarioInicio(),0,5)." ~ ".substr($t->getHorarioFim(),0,5);;?> </td>
              <td> <?php echo $t->getSetor();?> </td>
              <td> <?php echo $t->getSubSetor();?> </td>
              <td class="acao"> <href style="cursor: pointer;" onclick="window.location.href = './editar.php?cnpj='+$('#cnpj_<?php echo $count;?>').cleanVal();"> Editar </href> | <href style="cursor: pointer;" onclick="desativar(<?php echo $t->getCnpj(); ?>)"> Desativar </href> </td>
            </tr>
            <?php
            $count++;
			endforeach;
      }
      else{ ?>
        <tr>
          <td> 00.000.000.0001-00</td>
          <td> Nada </td>
          <td> Encontrado </td>
          <td> com a busca</td>
          <td> Informada </td>
          <td> Por favor </td>
          <td> Tente novamente!</td>
          <td class="acao"> =( </td>
        </tr> <?php
      }
      ?>
    </table>

    </center>

    <br><br>
    <center>
      <div id="div_3">
    <input type="button" value="Gerar Relatório" onclick="vaiGerar()">
  </div>
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
