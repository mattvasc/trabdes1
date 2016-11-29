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
			$categorias = $estabelecimento->getCategoria();
			?>
				$( document ).ready(function() {
					document.getElementById('cnpj').value = '<?php echo $estabelecimento->getCnpj();?>';
					document.getElementById('razao_social').value = '<?php echo $estabelecimento->getRazaoSocial();?>';
					document.getElementById('nome_fantasia').value= '<?php echo $estabelecimento->getNomeFantasia();?>';
					document.getElementById('n_funcionario').value= '<?php echo $estabelecimento->getNFuncionario();?>';
					$('#cnpj').mask('00.000.000/0000-00');
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
