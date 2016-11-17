<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="assets/jquery-3.1.1.js"></script>
	<script src="assets/jquery.mask.js"></script>
	<title>Cadastro</title>
	<script type="text/javascript">
		$(document).ready(function(){
			var SPMaskBehavior = function (val) {
			return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
			},
			spOptions = {
			onKeyPress: function(val, e, field, options) {
			field.mask(SPMaskBehavior.apply({}, arguments), options);
			}
			};
			$('#cnpj').mask('00.000.000/0000-00', {reverse: false});
			$('#telefone').mask(SPMaskBehavior, spOptions);
		});
	</script>
	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-validation.css">

</head>


	<header>
		<h1><center>2101 Airlines</center></h1>
    </header>

    <div class="main-content">

        <!-- You only need this form and the form-validation.css -->

        <form class="form-validation" method="post" action="#">

            <div class="form-title-row">
                <h1>Cadastro de Estabelecimento</h1>
            </div>
            <div class="form-row form-input-name-row">
                <label>
                    <span>CNPJ</span>
                    <!--aplicar mascara aqui-->
                    <input type="text" name="cnpj" id="cnpj">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>

            <div class="form-row form-input-name-row">
                <label>
                    <span>Razão Social</span>
                    <input type="text" maxlength="256" id="razao_social" name="razao_social">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>

            <div class="form-row form-input-name-row">

                <label>
                    <span>Nome Fantasia</span>
                    <input type="text" maxlength="256" name="razao_social" id="razao_social">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>

          <div class="form-row form-input-name-row">
            <label>
                  <span>Telefone</span>
              <!--aplicar mascara aqui-->
                <input type="tel" name="telefone" id="telefone">
              </label>
              <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
              <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
              <span class="form-invalid-data-info"></span>
          </div>

          <div class="form-row form-input-name-row">
            <label>
              <span>Site</span>
            <!--aplicar mascara aqui-->
              <input type="text" name="site">
            </label>
            <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
            <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
            <span class="form-invalid-data-info"></span>
          </div>

            <div class="form-row">

                <label>
                    <span>Local</span>
                    <select name="setor">
                        <option>Escolha...</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                        <option>E</option>
                    </select>
                </label>

            </div>
            <div class="form-row">

                <label>
                    <span>Subsetor</span>
                    <select name="subsetor">
                        <option>Escolha...</option>
                        <option>01</option>
                        <option>02</option>
                        <option>03</option>
                        <option>04</option>
                        <option>05</option>
                    </select>
                </label>

            </div>

            <div class="form-row">

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

            <div class="form-row">

                <button type="submit">Passo 2</button>

            </div>

        </form>

    </div>



<script>
/*
    $(document).ready(function() {

        // Here is how to show an error message next to a form field

        var errorField = $('.form-input-name-row');

        // Adding the form-invalid-data class will show
        // the error message and the red x for that field

        //errorField.addClass('form-invalid-data');
        //errorField.find('.form-invalid-data-info').text('Please enter your name');


        // Here is how to mark a field with a green check mark
        successField.addClass('form-valid-data');
    });
*/
</script>

</body>

</html>
