<?php
    $estabelecimento = file_get_contents('../model/estabelecimento.temp');
    if(empty($estabelecimento)){
        ?>
        <script type="text/javascript">

        window.location.href='../index.php';
        </script>
        <?php
    }
    // echo $_SESSION['estabelecimento']->cnpj;
    require_once('../model/estabelecimento.class.php');
    $estabelecimento = unserialize($estabelecimento);
    // $fp = fopen("/tmp/file.txt", "r+");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Cadastro: Responsável</title>
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery.mask.js"></script>

	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="assets/css/form-validation.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

</head>


	<header>
		<h1 onclick="window.location.href='../index.php'" style="cursor: pointer;">2101 Airlines</h1>
    </header>
    <div class="main-content" id = "teste">

        <form class="form-validation" method="post" id="form_responsavel" action="#">
            <div class="form-title-row">
                <h1>Cadastro de Responsável por estabelecimento: </h1>
            </div>
            <fieldset><legend>Responsável:</legend>
                <div id = "container">
                <div class="form-row form-input-nome_responsavel-row">
                    <label>
                        <span>Nome completo:</span>
                        <input type="text" id="nome" name="nome" onblur="validar_nome('nome')">
                    </label>
                    <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                    <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                    <span class="form-invalid-data-info"></span>
            </div>
            <div class="form-row form-input-cpf_responsavel-row">
                <label>
                    <span>CPF:</span>
                    <input type="text" id="cpf" onblur="verificar_cpf()">
                    <input type="hidden" id="cpf_sem_mascara" name="cpf">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>
            <div class="form-row form-input-telefone-row">
                <label>
                    <span>Telefone:</span>
                    <input type="tel" id="telefone" onblur="validar_telefone()">
                    <input type="hidden" name="telefone" id="telefone_sem_mascara">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>
            <div class="form row form-input-email-row">
                <label>
                    <span>E-mail:</span>
                    <input type="email" id="email" name="email">
                </label>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-sign"><i class="fa fa-close"></i></span>
                <span class="form-invalid-data-info"></span>
            </div><br><br>
        </div>
            </fieldset>
            <div class = "row">
            <div class="col-md-3 form-input-submit">
                <button type="button" onclick="validar()">Salvar</button>
                <span class="form-valid-data-sign"><i class="fa fa-check"></i></span>
                <span class="form-invalid-data-info"></span>
            </div>
            <div class="col-md-3 form-input-submit">
                <button type="button" onclick="retornar()">Concluído</button>
            </div>
        </div>
      </form>

    </div>


<footer>
    <script>
function retornar(){
    window.location.href="../index.php";
}

function validar(){
var resposta = true;
resposta = verificar_cpf() && resposta;
resposta = validar_nome('nome') && resposta;
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
    }else{
        campo.addClass('form-valid-data');
        return true;
    }
}
function validar_nome(nome){
    var patternValidaNome = /^[a-zA-Z\s]*$/;;

    var campo = $('.form-input-nome_responsavel-row');
    campo.removeClass('form-invalid-data');
    campo.removeClass('form-valid-data');
    var nome = document.getElementById(nome).value;
    if(nome.length == 0){
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('Campo Obrigatório!');
        return 0;
    }else if(nome.length < 6){
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('Valor muito curto!');
        return 0;
    }
    if(patternValidaNome.test(nome)){
        campo.addClass('form-valid-data');
        return 1;
        //alert(patternValidaNome.test(nome));
    }
    else{
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('Nome inválido!');
        return 0;
    }
}

function verificar_cpf(){
    var cpf = $('#cpf').cleanVal();
    document.getElementById('cpf_sem_mascara').value = cpf;
    var campo = $('.form-input-cpf_responsavel-row');
    campo.removeClass('form-invalid-data');
    campo.removeClass('form-valid-data');
    if(cpf.length == 0){
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('Campo obrigatório!');
        return 0;
    }
    if(cpf.length != 11){
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('Campo incompleto!');
        return 0;
    }
    var somatorio = 0;
    var resto;
    var digito_um;
    var digito_dois;
    somatorio += 10 * parseInt(cpf[0]);
    somatorio += 9 * parseInt(cpf[1]);
    somatorio += 8 * parseInt(cpf[2]);
    somatorio += 7 * parseInt(cpf[3]);
    somatorio += 6 * parseInt(cpf[4]);
    somatorio += 5 * parseInt(cpf[5]);
    somatorio += 4 * parseInt(cpf[6]);
    somatorio += 3 * parseInt(cpf[7]);
    somatorio += 2 * parseInt(cpf[8]);
    resto = somatorio % 11;

    if(resto < 2)
        digito_um = 0;
    else
        digito_um = 11 - resto;
    if(digito_um != parseInt(cpf[9])){
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('CPF inválido');
        return 0;
    }
    somatorio = 0;
    somatorio += 11 * parseInt(cpf[0]);
    somatorio += 10 * parseInt(cpf[1]);
    somatorio += 9 * parseInt(cpf[2]);
    somatorio += 8 * parseInt(cpf[3]);
    somatorio += 7 * parseInt(cpf[4]);
    somatorio += 6 * parseInt(cpf[5]);
    somatorio += 5 * parseInt(cpf[6]);
    somatorio += 4 * parseInt(cpf[7]);
    somatorio += 3 * parseInt(cpf[8]);
    somatorio += 2 * parseInt(cpf[9]);
    resto = somatorio % 11;
    if(resto < 2)
        digito_dois = 0;
    else
        digito_dois = 11 - resto;
    if(digito_dois != parseInt(cpf[10])){
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('CPF inválido');
        return 0;
    }
    if(verificar_existencia_cpf()){
        campo.addClass('form-valid-data');
        return 1;
    }else{
        campo.addClass('form-invalid-data');
        campo.find('.form-invalid-data-info').text('CPF já cadastrado');
        return 0;
    }

}
function verificar_existencia_cpf(){
    return $.ajax({
        url:'..control/verificar_existencia_cpf.php',
        type: "POST",
        data: {cpf: $('#cpf').cleanVal(), cnpj: "<?php echo $estabelecimento->getCnpj(); ?>"},
        success: function(result){
            result = JSON.parse(result);
            if(result == '1'){
                $('.form-input-cpf_responsavel-row').removeClass('form-invalid-data');
                $('.form-input-cpf_responsavel-row').removeClass('form-valid-data');
                $('.form-input-cpf_responsavel-row').addClass('form-invalid-data');
                $('.form-input-cpf_responsavel-row').find('.form-invalid-data-info').text('CPF já cadastrado nesta loja!');
                return 0;
            }else
                return 1;
        }

    });
};


    $(document).ready(function(){
        responsavel_indice = 0;
        //A linha a seguir é para a mascára do telfone:
        var SPMaskBehavior = function (val) {return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';	},spOptions = {onKeyPress: function(val, e, field, options) {field.mask(SPMaskBehavior.apply({}, arguments), options);}};
        $('#cpf').mask('000.000.000-00', {reverse: false});
        $('#telefone').mask(SPMaskBehavior, spOptions);

    });

    </script>
    <?php
         require_once('../control/cadastro_responsavel.php');
    ?>
</footer>

</body>

</html>
