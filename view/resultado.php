<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<script src="assets/js/jquery-3.1.1.js"></script>
		<script src="assets/js/jquery.mask.js"></script>
		<link rel="stylesheet" href="assets/css/demo.css">
		<link rel="icon" href="assets/icone.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="assets/icone.ico" type="image/x-icon" />
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
							<div id="voltar_div">
							<input type="button" value="Voltar" id="voltar" onclick="voltar()">
						</div>

          </div>
        </div>
			<form method="post" id="theForm" action="../control/gerar_pdf.php">
					<input type="hidden" name="imprimir" id="imprimir">
			</form>




    </div>
		<footer>
			<script>
				function voltar(){
					window.history.back();
					window.location.href = "../index.php";
				}
				function vaiGerar(){
					$(".acao").remove();
					document.getElementById('voltar_div').innerHTML = "";
					document.getElementById('div_3').innerHTML = "";
					document.getElementById('imprimir').value = document.documentElement.innerHTML;
					document.getElementById('theForm').submit();
				}
				$(document).ready(function(){
				$('.cnpj-mask').mask('00.000.000/0000-00', {reverse: false});
				});

				function desativar(cnpj_arg)
				{
					var r = confirm("Tem certeza de que gostaria de desativar o estabelecimento de CPNJ: "+cnpj_arg+"?");
					if (r) {
					$.ajax({
					url: '../control/apagar.php',
					type: "POST",
					data: {cnpj:cnpj_arg},
					success: function (result) {
							alert("Estabelecimento desativado com sucesso!");
							window.location.href = "../index.php";
						}
					});
					}
				}

    </script>
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
		</footer>
</body>



</html>
