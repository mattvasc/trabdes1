<?php
	if(isset($_GET['cnpj']))
	{
		require_once('Connection.php');
		require_once('../model/estabelecimento.class.php');
		$cnpj = $_GET['cnpj'];
		$estabelecimento = new Estabelecimento($cnpj);
		if(!$estabelecimento->carregar())
		{
			?>
				alert("CNPJ NÃO CADASTRADO!");
			<?php
		}
		else
		{
			$estabelecimento->carregarCategoria();
			$estabelecimento->carregarLocal();
			$estabelecimento->carregarHorario();
			$categorias = $estabelecimento->getCategoria();
			?>
			function SubSetorizar() {
				$('.form-input-setor-row').removeClass('form-invalid-data');
				$('.form-input-setor-row').removeClass('form-valid-data');
				var select = document.getElementById("SubSetor");
				var option;

				while (select.length > 1) {
					select.remove(select.length-1);
				}

				return $.ajax({
					url: '../control/setor.php',
					type: "POST",
					data: { Setor: $('#setor').val(), busca_limpa : 2, cnpj: document.getElementById("cnpj-semmask").value },
					// dataType: 'application/json; charset=utf-8',
					success: function (result) {
						result = JSON.parse(result);
							for (var x = 0; x < result.length; x++) {
								//alert(result[x]);
								option = document.createElement('option');
								option.text = option.value = result[x];
								select.add(option, select.length);
							}
						return 1;
					}
			});
			}
				$( document ).ready(function() {
					document.getElementById('cnpj').value = '<?php echo $estabelecimento->getCnpj();?>';
					document.getElementById('razao_social').value = '<?php echo $estabelecimento->getRazaoSocial();?>';
					document.getElementById('nome_fantasia').value= '<?php echo $estabelecimento->getNomeFantasia();?>';
					document.getElementById('n_funcionario').value= '<?php echo $estabelecimento->getNFuncionario();?>';
					$('#horario').val("<?php echo $estabelecimento->getHorarioInicio().','.$estabelecimento->getHorarioFim();?>");
					document.getElementById('cnpj-semmask').value = document.getElementById('cnpj');
					$('#cnpj').mask('00.000.000/0000-00');
					$('#setor').val("<?php echo $estabelecimento->getSetor();?>");

					document.getElementById('data_inicio').value= '<?php echo implode('/',array_reverse(explode('-',$estabelecimento->getDataInicio())));?>';
					<?php if($estabelecimento->getDataFim()){
							?>
								document.getElementById('data_fim').value= '<?php echo implode('/',array_reverse(explode('-',$estabelecimento->getDataFim())));?>';
							<?php
					}
					 ?>
					 $('#data_inicio').mask('00/00/0000');
					 $('#data_fim').mask('00/00/0000');
					<?php if($estabelecimento->getTelefone()){
						?>
							document.getElementById('telefone').value= '<?php echo $estabelecimento->getTelefone()?>';
						<?php
					}?>
					<?php if($estabelecimento->getSite()){
						?>
						document.getElementById('site').value= '<?php echo $estabelecimento->getSite();?>';
						<?php
					}
					foreach($categorias as $cat){
						?>
						//	$('#<?php echo $cat; ?>').prop('checked', true);
						document.getElementById("<?php echo $cat; ?>").checked = true;
						<?php
					}
					?>
				});
			<?php
		}
	}
	else{
		?>
			alert("CPNJ IS MISSING!");
			window.location.href = '../index.php';
		<?php
	}
?>
