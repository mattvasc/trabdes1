<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="assets/jquery-3.1.1.js"></script>
	<script src="assets/jquery.mask.js"></script>
	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-validation.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

	<title>Cadastro</title>
	<script type="text/javascript">
		function validar(){
			if(validar_cnpj() && validar_string('razao_social') && validar_string('nome_fantasia') && validar_string_op('site') && validar_telefone())
			{
				document.getElementById("myform").submit();
			}
			else {
				alert("Dados inválidos! Revise o formulário e tente novamente");
			}
		}
		function validar_telefone()
		{
			var Field = $('.form-input-telefone-row');
			Field.removeClass('form-invalid-data');
			Field.removeClass('form-valid-data');
			var value = $('#telefone').cleanVal();
			if(value.length != 10 && value.length != 11 && value.length != 0)
			{
				Field.addClass('form-invalid-data');
				Field.find('.form-invalid-data-info').text('Informe um telefone Válido!');
				return false;
			}
			else if(value.length != 0){
				Field.addClass('form-valid-data');
				return true;
			}
			return true;
		}

		function validar_string(id)
		{
				var str1 = '.form-input-';
				var str2 = id;
				var str3 = '-row';
				var Field = $(str1.concat(str2,str3));
				Field.removeClass('form-invalid-data');
				Field.removeClass('form-valid-data');
				var str4 = document.getElementById(id).value;
				if(str4.length>3)
				{
					Field.addClass('form-valid-data');
					return 1;
				}
				else if(str4.length==0)
				{
						Field.addClass('form-invalid-data');
						Field.find('.form-invalid-data-info').text('Campo Obrigatório!');
						return 0;
				}
				else
				{
						Field.addClass('form-invalid-data');
						Field.find('.form-invalid-data-info').text('Valor muito curto!');
						return 0;
				}
		}
		function validar_string_op(id)
		{
				var str1 = '.form-input-';
				var str2 = id;
				var str3 = '-row';
				var Field = $(str1.concat(str2,str3));
				Field.removeClass('form-invalid-data');
				Field.removeClass('form-valid-data');
				var str4 = document.getElementById(id).value;
				if(str4.length>3)
				{
					Field.addClass('form-valid-data');
					return 1;
				}
			return 1;
		}
		function validar_cnpj()
		{
			var cnpj = $('#cnpj').cleanVal();
			var Field = $('.form-input-cnpj-row');
			Field.removeClass('form-invalid-data');
			Field.removeClass('form-valid-data');
			if(cnpj.length!=14){
				Field.addClass('form-invalid-data');
				Field.find('.form-invalid-data-info').text('Campo obrigatório!');
				return 0;
			}
			var resto;
			var primeiro_digito;
			var segundo_digito;
			var somatorio = 0;
			somatorio+= 5 * parseInt(cnpj[0]);
			somatorio+= 4 * parseInt(cnpj[1]);
			somatorio+= 3 * parseInt(cnpj[2]);
			somatorio+= 2 * parseInt(cnpj[3]);
			somatorio+= 9 * parseInt(cnpj[4]);
			somatorio+= 8 * parseInt(cnpj[5]);
			somatorio+= 7 * parseInt(cnpj[6]);
			somatorio+= 6 * parseInt(cnpj[7]);
			somatorio+= 5 * parseInt(cnpj[8]);
			somatorio+= 4 * parseInt(cnpj[9]);
			somatorio+= 3 * parseInt(cnpj[10]);
			somatorio+= 2 * parseInt(cnpj[11]);
			resto = somatorio%11;
			if(resto<2)
				primeiro_digito = 0;
			else
				primeiro_digito = 11-resto;
			if(parseInt(cnpj[12])!=primeiro_digito){
				Field.addClass('form-invalid-data');
				Field.find('.form-invalid-data-info').text('Informe um CNPJ Válido!');
				return 0;
			}
			somatorio = 0;
			somatorio += 6 * parseInt(cnpj[0]);
			somatorio += 5 * parseInt(cnpj[1]);
			somatorio += 4 * parseInt(cnpj[2]);
			somatorio += 3 * parseInt(cnpj[3]);
			somatorio += 2 * parseInt(cnpj[4]);
			somatorio += 9 * parseInt(cnpj[5]);
			somatorio += 8 * parseInt(cnpj[6]);
			somatorio += 7 * parseInt(cnpj[7]);
			somatorio += 6 * parseInt(cnpj[8]);
			somatorio += 5 * parseInt(cnpj[9]);
			somatorio += 4 * parseInt(cnpj[10]);
			somatorio += 3 * parseInt(cnpj[11]);
			somatorio += 2 * parseInt(cnpj[12]);
			resto = somatorio%11;
			if(resto<2)
				segundo_digito = 0;
			else
				segundo_digito = 11-resto;
			if(parseInt(cnpj[13])!=segundo_digito){
				Field.addClass('form-invalid-data');
				Field.find('.form-invalid-data-info').text('Informe um CNPJ Válido!');
				return 0;
			}
			Field.addClass('form-valid-data');
			return 1;
		};
		$(document).ready(function(){
			//A linha a seguir é para a mascára do telfone:
			var SPMaskBehavior = function (val) {return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';	},spOptions = {onKeyPress: function(val, e, field, options) {field.mask(SPMaskBehavior.apply({}, arguments), options);}};
			$('#cnpj').mask('00.000.000/0000-00', {reverse: false});
			$('#telefone').mask(SPMaskBehavior, spOptions);
			/*
			 var errorField = $('.form-input-site-row');
			 Field.addClass('form-invalid-data');
			Field.find('.form-invalid-data-info').text('Informe um site Válido!');
			 errorField.removeClass('form-invalid-data');
			 var successField = $('.form-input-site-row');
 			 successField.addClass('form-valid-data');
 			 sucessField.addClass('form-invalid-data');
			 */
		});
	</script>

	<script>
		function SubSetorizar() {

			var select = document.getElementById("SubSetor");
			var option;

			while (select.length > 1) {
				select.remove(select.length-1);
			}

			$.ajax({
        url: '../control/setor.php',
        type: "POST",
        data: { Setor: $('#setor').val() },
        //dataType: 'application/json; charset=utf-8',
        success: function (result) {
					result = JSON.parse(result);

						//alert(data);
            for (var x = 0; x < result.length; x++) {
							//alert(result[x]);
							option = document.createElement('option');
			        option.text = option.value = result[x];
			        select.add(option, select.length);
						}
        }
    });
		}

	</script>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-validation.css">

</head>


	<header>
		<h1><center>2101 Airlines</center></h1>
    </header>

    <div class="main-content">

        <!-- You only need this form and the form-validation.css -->

        <form class="form-validation" id="myform" method="post" action="#">

            <div class="form-title-row">
                <h1>Cadastro de Estabelecimento</h1>
            </div>
            <div class="form-row form-input-cnpj-row">
                <label>
                    <span>CNPJ</span>
                    <!--aplicar mascara aqui-->
                    <input type="text" name="cnpj" id="cnpj" onblur="validar_cnpj();">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>

            <div class="form-row form-input-razao_social-row">
                <label>
                    <span>Razão Social</span>
                    <input type="text" maxlength="256" id="razao_social" onblur="validar_string('razao_social')" name="razao_social">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>

            <div class="form-row form-input-nome_fantasia-row">

                <label>
                    <span>Nome Fantasia</span>
                    <input type="text" maxlength="256" onblur="validar_string('nome_fantasia')" name="nome_fantasia" id="nome_fantasia">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>

          <div class="form-row form-input-telefone-row">
            <label>
                  <span>Telefone</span>
              <!--aplicar mascara aqui-->
                <input type="tel" name="telefone" id="telefone" onblur="validar_telefone()">
              </label>
              <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
              <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
              <span class="form-invalid-data-info"></span>
          </div>

          <div class="form-row form-input-site-row">
            <label>
              <span>Site</span>
            <!--aplicar mascara aqui-->
              <input type="text" name="site" id="site" onblur="validar_string_op('site')">
            </label>
            <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
            <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
            <span class="form-invalid-data-info"></span>
          </div>

            <div class="form-row form-input-setor-row">

                <label>
                    <span>Setor</span>
                    <select name="setor" id="setor" onchange="SubSetorizar();">
                        <option>Escolha...</option>
                    </select>
                </label>

            </div>
            <div class="form-row form-input-local-subsetor">

                <label>
                    <span>Subsetor</span>
                    <select name="subsetor" id="SubSetor">
                        <option>Escolha...</option>
                    </select>
                </label>

            </div>

            <div class="form-row form-input-categoria">

                <label class="form-checkbox">
                  <!--TAB é no CSS -->
                    <span>Categoria</span><br>
                    <table>
                      <tr>
                        <td><input type="checkbox" name="checkbox_aluguel_carros" value="Aluguel de Carros">Aluguel de Carros</td>
                        <td><input type="checkbox" name="checkbox_fastfood" value="Fast Food"> Fast Food</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="checkbox_banco" value="Banco"> Banco</td>
                        <td><input type="checkbox" name="checkbox_livraria" value="Livraria"> Livraria</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="checkbox_bar" value="Bar"> Bar</td>
                        <td><input type="checkbox" name="checkbox_orgao" value="Órgão Públicos"> Órgão Público</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="checkbox_cafe" value="Café"> Café</td>
                        <td><input type="checkbox" name="checkbox_moda" value="Moda/Presentes"> Moda/Presentes</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="checkbox_casa_cambio" value="Casa de Câmbio"> Casa de Câmbio</td>
                        <td><input type="checkbox" name="checkbox_perfumaria" value="Perfumaria"> Perfumaria</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="checkbox_doce" value="Doces e Sorvetes"> Doces e Sorvetes</td>
                        <td><input type="checkbox" name="checkbox_restaurante" value="Restaurante"> Restaurante</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="checkbox_drogaria" value="Drogaria"> Drogaria </td>
                        <td><input type="checkbox" name="checkbox_transporte_carga" value="Transporte de Carga"> Transporte de Carga</td>
                      </tr>
                    </table>

                </label>

            </div>

            <div class="form-row ">

                <button type="button" onclick="validar()">Próximo</button>

            </div>

        </form>

    </div>

</body>

<?php
	 require_once('../control/cadastro_estabelecimento.php');
?>

</html>
