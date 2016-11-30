<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<script src="assets/js/jquery-3.1.1.js"></script>
		<script src="assets/js/jquery.mask.js"></script>
		<link rel="stylesheet" href="assets/css/demo.css">
		<?php
		if(file_exists('../model/resultado.temp'))
			echo '<link rel="stylesheet" href="assets/css/form-validation-modificado.css">';
		else
			echo '<link rel="stylesheet" href="assets/css/form-validation.css">';
		?>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		<title>Resultado</title>
</head>
<body>
	<header>
		<h1 onclick="window.location.href='../index.php'" style="cursor: pointer;">2101 Airlines</h1>
	</header>
    <div class="main-content">

        <!-- You only need this form and the form-validation.css -->
        <div class="form-validation">
          <div class="form-title-row">
              <h1>Resultado da Pesquisa:</h1>
							<br><br><br><br>
              <div id="resultado" name="resultado" class="form-row form-input-cnpj-row">
                <?php require_once('../control/resultado.php'); ?>
              </div>

							<input type="button" value="Voltar">

          </div>
        </div>





    </div>
		<footer>

		</footer>
</body>



</html>
