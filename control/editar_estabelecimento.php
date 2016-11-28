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
			?>
				$( document ).ready(function() {
					document.getElementById('cnpj').value = '<?php echo $estabelecimento->getCnpj();?>';
					document.getElementById('razao_social').value = '<?php echo $estabelecimento->getRazaoSocial();?>';
					document.getElementById('nome_fantasia').value= '<?php echo $estabelecimento->getNomeFantasia();?>';
					document.getElementById('n_funcionario').value= '<?php echo $estabelecimento->getNFuncionario();?>';

					<?php if($estabelecimento->getTelefone()){
						?>
							document.getElementById('telefone').value= '<?php echo $estabelecimento->getTelefone()?>';
						<?php
					}?>
					<?php if($estabelecimento->getSite()){
						?>
						document.getElementById('site').value= '<?php echo $estabelecimento->getSite();?>';
						<?php
					}?>
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
