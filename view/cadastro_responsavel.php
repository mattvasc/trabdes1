<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Cadastro: Responsável</title>

	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="assets/css/form-validation.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

</head>


	<header>
		<h1>2101 Airlines</h1>
    </header>
    <div class="main-content">

        <!-- You only need this form and the form-validation.css -->

        <form class="form-validation" id="form_responsavel" method="post" action="#">
          <!--Imprimir o nome do estabelecimento-->
            <div class="form-title-row">
                <h1>Cadastro de Responsável por estabelecimento</h1>
            </div>
            <fieldset><legend>Responsável:</legend>
                <div class="form-row form-input-nome_responsavel-row">
                    <label>
                        <span>Nome completo:</span>
                        <input type="text" id="nome" name="nome[]" onblur="validar_nome('nome')">
                    </label>
                    <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                    <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                    <span class="form-invalid-data-info"></span>
            </div>
            <div class="form-row form-input-cpf_responsavel-row">
                <label>
                    <span>CPF:</span>
                    <input type="text" id="cpf" name="cpf" onblur="verificar_cpf();">
                    <input type="hidden" id="cpf_sem_mascara" name="cpf[]">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>
            <div class="form-row form-input-telefone-row">
                <label>
                    <span>Telefone:</span>
                    <input type="tel" id="telefone" onblur="validar_telefone()">
                    <input type="hidden" name="telefone" id="telefone_sem_mascara" onblur="validar_telefone">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>
            <div class="form row form-input-email-row">
                <label>
                    <span>E-mail:</span>
                    <input type="email" id="email" name="email" onblur="validar_email('email')">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div><br><br>
            </fieldset>
            <div class="form-row form-input-submit">
                <button type="button" onclick="validar()">Salvar</button>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>
        </form>
    </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<footer>
    <script type="text/javascript">
        function validar(){
            var resposta = true;
            resposta = verificar_cpf() && resposta;
            resposta = validar_nome('nome') && resposta;
            resposta = validar_email('email') && resposta;
            resposta = validar_telefone() && resposta;

            $('.form-input-submit').removeClass('form-invalid-data');
            $('.form-input-submit').removeClass('form-valid-data');
            if(resposta){
                document.getElementById("cpf_sem_mascara").value = $('#cpf').cleanVal();
                document.getElementById("telefone_sem_mascara").value = $('#telefone').cleanVal();
                document.getElementById("form_responsavel").submit();
            }else{
                $('.form-input-submit').addClass('form-invalid-data');
                $('.form-input-submit').find('.form-invalid-data-info').text('Formulário contém erros!');
            }
        }

function validar_telefone(){
    var campo = $('.form-input-telefone-row');
    campo.removeClass('form-invalid-data');
    campo.removeClass('form-valid-data');
    var tel = $('#telefone').cleanVal();

    if(tel.length != 10 && tel.length != 11){
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('Informe um telefone válido!');
        return false;
    }else
        return true;
}

function validar_nome(nome){
    var patternValidaNome = "^([a-zA-Z]{2,}\\s[a-zA-z]{1,}'?-?[a-zA-Z]{2,}\\s?([a-zA-Z]{1,})?";

    <!--http://stackoverflow.com/questions/2385701/regular-expression-for-first-and-last-name -->

    var campo = $('.form-input-nome_responsavel-row');
    campo.removeClass('form-invalid-data');
    campo.removeClass('form-valid-data');
    var nome = document.getElementById(nome).value;
    if(nome.length == 0){
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('Campo Obrigatório!');
        return 0;
    }else if(nome.length < 10){
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('Valor muito curto!');
        return 0;
    }
    if(patternValidaNome.test(nome))
        return 1;
    else{
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('Nome inválido!');
        return 0;
    }
}

function validar_email(field){
    <!-- http://www.devmedia.com.br/validando-e-mail-em-inputs-html-com-javascript/26427-->
usuario = field.value.substring(0, field.value.indexOf("@"));
dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);

if ((usuario.length >= 1) &&
    (dominio.length >= 3) &&
    (usuario.search("@") == -1) &&
    (dominio.search("@") == -1) &&
    (usuario.search(" ") == -1) &&
    (dominio.search(" ") == -1) &&
    (dominio.search(".") != -1) &&
    (dominio.indexOf(".") >= 1)&&
    (dominio.lastIndexOf(".") < dominio.length - 1)) {
        field.addClass('form-valid-data');
        return 1;
}else{
    field.addClass('form-invalid-data');
    field.find('.form-invalid-data-info').text('E-mail inválido!');
    return 0;
    }
}

<!--falta validar cpf e DOM -->

    </script>
</footer>



</body>

</html>
