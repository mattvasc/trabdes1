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
		<title>Consultas e Relatório</title>
</head>
<body>
	<header>
		<h1 onclick="window.location.href='../index.php'" style="cursor: pointer;">2101 Airlines</h1>
	</header>
    <div class="main-content">

        <!-- You only need this form and the form-validation.css -->

        <form class="form-validation" id="myform" method="post" action="..\control\busca.php">


            <div class="form-title-row">
                <h1>Consultas e Relatórios </h1>
            </div>


                <label>
                    <span>Pesquisar por:</span>
                    <select name="tipo" id="tipo">
												<option value="cnpj">CNPJ</option>
												<option value="fantasia">Nome Fantasia</option>
												<option value="razao">Razao Social</option>
                        <option value="local">Local</option>
                        <option value="categoria">Categoria</option>
                        <option value="horario">Horario de Funcionamento</option>
                    </select>
                </label>


            <form method="GET" action="busca.php">
  <label for="consulta">Buscar:</label>
  <input type="text" id="consulta" name="consulta" maxlength="255" />

	<button type="submit" name="rank" value="${rank}">buscar</button>


</form>

<tbody>

</tbody>

		<footer>


		</footer>
</body>

</html>
