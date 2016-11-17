<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Cadastro: Responsável por estabelecimento</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-validation.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

</head>


	<header>
		<h1>Cadastro de Responsável por estabelecimento</h1>
    </header>
    <div class="main-content">

        <!-- You only need this form and the form-validation.css -->

        <form class="form-validation" method="post" action="#">
          <!--imprimir o nome do estabelecimento-->
            <div class="form-row form-input-name-row">


                <label>
                    <span>Nome completo:</span>
                    <input type="text" name="nome">
                </label>
                <label>
                    <span>CPF</span>
                    <input type="text" name="cpf">
                </label>
                <label>
                    <span>Telefone</span>
                    <input type="tel" name="telefone">
                </label>
                <label>
                    <span>E-mail</span>
                    <input type="email" name="email">
                </label>

                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>

                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>

            </div>
            <div class="form-row">
                <span>Mais responsáveis?</span>
                <div class="form-radio-buttons">
                    <div>
                      <form action="">
                        <input type="radio" name="radio_button" value="Sim"> Sim<br>
                        <input type="radio" name="radio_button" value="Não"> Não<br>

                      </form>
                    </div>

                    <div class="form-row form-input-name-row">

                        <label>
                            <span>Número de funcionários</span>
                            <input type="number" name="n_funcionarios">
                        </label>
                        <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                        <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                        <span class="form-invalid-data-info"></span>

                    </div>

            <div class="form-row">

                <button type="submit">Passo 3</button>

            </div>

        </form>

    </div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>

    $(document).ready(function() {

        // Here is how to show an error message next to a form field

        var errorField = $('.form-input-name-row');

        // Adding the form-invalid-data class will show
        // the error message and the red x for that field

      //  errorField.addClass('form-invalid-data');
      //  errorField.find('.form-invalid-data-info').text('Please enter your name');


        // Here is how to mark a field with a green check mark

        var successField = $('.form-input-email-row');

        successField.addClass('form-valid-data');
    });

</script>

</body>

</html>
