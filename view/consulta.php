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

        <form class="form-validation" id="myform" method="post" action="../control/busca.php">


            <div class="form-title-row">
                <h1>Consultas e Relatórios </h1>
            </div>


                <label>
                    <span>Pesquisar por:</span>
                    <select name="tipo" id="tipo" onchange="mudou()">
												<option value="">Selecione</option>
												<option value="cnpj">CNPJ</option>
												<option value="nome_fantasia">Nome Fantasia</option>
												<option value="razao_social">Razao Social</option>
                        <option value="local">Local</option>
                        <option value="categoria">Categoria</option>
                        <option value="horario">Horario de Funcionamento</option>
                    </select>
                </label> <br> <br>
								<input type="hidden" name="consulta_dado" id="consulta_dado" >
								<div id='coisa' >
								</div>

								<button type="button" name="rank" onclick="validar()">buscar</button>


</form>

<tbody>

</tbody>

		<footer>
				<script>
				function validar(){
					var tipo = document.getElementById('tipo').value;
					if(tipo == "cnpj"){
						if(validar_cnpj()){
							document.getElementById('consulta_dado').value = $('#cnpj').cleanVal();
							// document.getElementById('myform').submit();
							alert("salvando!");
						}
					}
					else if(tipo == "nome_fantasia" || tipo == "razao_social"){
							if(validar_string('campo')){
								var invisivel = document.getElementById('consulta_dado');
								var campox = document.getElementById('campo')
								invisivel.value = campox.value;
							  document.getElementById('myform').submit();

							}
					}
					else if(tipo == "local"){
						if(validar_combobox(0) && validar_combobox(1)){
								document.getElementById('consulta_dado').value = document.getElementById('setor').value + ','+document.getElementById('subsetor').value
								document.getElementById('myform').submit();
						}

						else {
							alert("Selecione todos os combos!");
						}

					}
					else if(tipo == "categoria"){
							var getArrVal = $('input[type="checkbox"][name="chkBx[]"]:checked').map(function(){
							return this.value;
						}).toArray();
						if(!getArrVal.length){
							alert("Selecione ao menos uma Cateoria!");
						}
						else{
							var c;
								for(c=0;c< getArrVal.length; c++)
									if(c==0)
										document.getElementById('consulta_dado').value = getArrVal[0];
									else
										document.getElementById('consulta_dado').value += ","+getArrVal[0];
										
								document.getElementById('myform').submit();
						}
					}
					else if(tipo=="horario"){ //horario
						if(validar_combobox(2)){
							document.getElementById('consulta_dado').value = document.getElementById('horario').value;
							document.getElementById('myform').submit();
						}
						else {
							alert("Selecione um horário!");
						}
					}
					else{
						alert('Erro!');
					}

				}

					function mudou(){
						var tipo = document.getElementById('tipo').value;
						var div = document.getElementById('coisa');
						if(tipo == "cnpj"){
							div.innerHTML = '<label for="cnpj">CNPJ:</label>';
							div.innerHTML+='	<input type="text" id="cnpj" name="consulta" maxlength="255" />';
							$('#cnpj').mask('00.000.000/0000-00', {reverse: false});

						}
						else if(tipo == "nome_fantasia"){
							div.innerHTML = '<label for="consulta">Nome Fantasia:</label>';
							div.innerHTML+='	<input type="text" id="campo" name="consulta" maxlength="255" />';
						}
						else if(tipo == "razao_social"){
							div.innerHTML = '<label for="consulta">Razão Social:</label>';
							div.innerHTML+='	<input type="text" id="campo" name="consulta" maxlength="255" />';
						}
						else if(tipo == "local"){
							div.innerHTML = '<label for="setor">Setor:</label>';
							div.innerHTML+='	<select name="setor" id="setor" onchange="SubSetorizar()"><option value="">Selecione</option>	</select>';
							div.innerHTML+=' <br><br>';
							div.innerHTML += '<label for="setor">Subsetor:</label>';
							div.innerHTML+='	<select name="subsetor" id="subsetor"> <option value="">Selecione</option></select><br>';
							var select = document.getElementById('setor');
							var option;
							$.ajax({
								url: '../control/ajax_setor.php',
								type: "POST",
								data: { frase: 'oi' },
								success: function (result) {
									result = JSON.parse(result);
									for (var x = 0; x < result.length; x++) {
										option = document.createElement('option');
										option.text = option.value = result[x];
										select.add(option, select.length);
									}
								}
						});


						}

						else if(tipo == "categoria"){
							div.innerHTML = '<input type="checkbox" name="gambiarra" id="gambiarra" value="" style="display:none">';
							$.ajax({
								url: '../control/ajax_categoria.php',
								type: "POST",
								data: { frase: 'oi' },
								success: function (result) {
									result = JSON.parse(result);
									for (var x = 0; x < result.length; x++) {
										div.innerHTML+= '<label><input type ="checkbox" name="chkBx[]" value ="'+result[x]+'" id="'+ result[x] +'">'+result[x]+'</label><br>';
									}
								}
						});

						}
						else if(tipo=="horario"){ //horario
							div.innerHTML='<select name="horario" id="horario"><option value="">Selecione</option></select>';
							var select = document.getElementById('horario');
							var arrai;
							$.ajax({
								url: '../control/ajax_horario.php',
								type: "POST",
								data: { variavel: 'oi' },
								success: function (result) {
									result = JSON.parse(result);
										for (var x = 0; x < result.length; x++) {
											option = document.createElement('option');
											if(result[x]=='00:00:00,23:59:59')
												option.text = '24 Horas';
											else{
												arrai = result[x].split(',');
												option.text = arrai[0] + " ~ " + arrai[1];
											}
											option.value = result[x];
											select.add(option, select.length);
										}
								}
						});
						}
						else
							div.innerHTML="";
					}

						$(document).ready(function(){
								mudou();
						});

						function SubSetorizar() {
							var select = document.getElementById("subsetor");
							var option;

							while (select.length > 1) {
								select.remove(select.length-1);
							}

							$.ajax({
				        url: '../control/setor.php',
				        type: "POST",
				        data: { Setor: $('#setor').val() },
				        // dataType: 'application/json; charset=utf-8',
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

						function validar_cnpj()
						{
							var cnpj = $('#cnpj').cleanVal();
							if(cnpj.length == 0){
								alert("CNPJ Obrigatório");
								return 0;
							}
							if(cnpj.length!=14){
								alert("CNPJ Incompleto");
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
								alert('Informe um CNPJ Válido!');
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
							alert('Informe um CNPJ Válido!');
								return 0;
							}
							return 1;
						};

						function validar_string(id)
						{
								var str4 = document.getElementById(id).value;
								if(str4.length>3)
								{
									return 1;
								}
								else if(str4.length==0)
								{
										alert('Campo Obrigatório!');
										return 0;
								}
								else
								{
									alert('Valor muito curto!');
										return 0;
								}
						}

						function validar_combobox(combobox){
								var selecionado; var classe;
								if(combobox==0){
								 	selecionado = $("#setor").val();
								}
								else if(combobox==1){
									selecionado = $('#subsetor').val();
								}
								else if(combobox==2){
									selecionado = $('#horario').val();
								}
								if(selecionado)
									return 1;
								return 0;
						}
				</script>

		</footer>
</body>

</html>
