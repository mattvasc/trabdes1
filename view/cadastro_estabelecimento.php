<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<script src="assets/js/jquery-3.1.1.js"></script>
		<script src="assets/js/jquery.mask.js"></script>
		<link rel="stylesheet" href="assets/css/demo.css">
		<link rel="stylesheet" href="assets/css/form-validation.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		<title>Cadastro</title>
</head>
<body>
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
                        <option value="">Escolha...</option>
                    </select>
                </label>
								<span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
		            <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
		            <span class="form-invalid-data-info"></span>
            </div>
            <div class="form-row form-input-subsetor-row">

                <label>
                    <span>Subsetor</span>
                    <select name="subsetor" id="SubSetor">
                        <option value="">Escolha...</option>
                    </select>
                </label>
								<span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
		            <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
		            <span class="form-invalid-data-info"></span>
            </div>
            <div  align="center" class="form-row form-input-categoria-row" >

                <label class="form-checkbox">
                  <!--TAB é no CSS -->

                    <span>Categoria</span><br><br>
                    <div name="categoria_tbl" id="categoria_tbl" align="left">
											<input type='checkbox' name="gambiarra" id="gambiarra" value="" style="display:none">
                    </div>

                </label>
								<span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
		            <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
		            <span class="form-invalid-data-info"></span>
            </div>
            <div class="form-row ">

                <button type="button" onclick="validar()">Próximo</button>

            </div>

        </form>

    </div>
		<footer>
			<script type="text/javascript">
				function validar(){
					var resposta = true;
					resposta = resposta && validar_cnpj();
					resposta = validar_string('razao_social') && resposta;
					resposta = validar_string('nome_fantasia') && resposta;
					resposta = validar_string_op('site') && resposta;
					resposta = validar_telefone() && resposta;
					resposta = validar_setor(1) && resposta;
					resposta = validar_setor(0) && resposta;
					resposta = validar_categoria() && resposta;

					if(resposta)
					{
						document.getElementById("myform").submit();
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
				function validar_setor(subsetor){
						var selecionado; var classe;
						if(!subsetor){
						 	selecionado = $("#SubSetor").val();
							classe = $('.form-input-subsetor-row');
						}
						else{
							selecionado = $('#setor').val();
							classe = $('.form-input-setor-row');
						}
						classe.removeClass('form-invalid-data');
						classe.removeClass('form-valid-data');
						if(selecionado)
							return 1;
						classe.addClass('form-invalid-data');
						classe.find('.form-invalid-data-info').text('Campo obrigatório!');
						return 0;
				}
				function validar_categoria()
				{
					var classe = $('.form-input-categoria-row');
					classe.removeClass('form-invalid-data');
					classe.removeClass('form-valid-data');
					var getArrVal = $('input[type="checkbox"][name="chkBx"]:checked').map(function(){
		        return this.value;
		      }).toArray();
		      if(!getArrVal.length){
						classe.addClass('form-invalid-data');
						classe.find('.form-invalid-data-info').text('Selecione ao menos uma!');
						return 0;
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
				});
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
			<?php
				 require_once('../control/cadastro_estabelecimento.php');
			?>
		</footer>
</body>



</html>
