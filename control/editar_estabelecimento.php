<?php
	if(isset($_GET['cnpj']))
	{
		
	}
	else{
		?>
			alert("CPNJ IS MISSING!");
			window.location.href = '../index.php';
		<?php
	}
?>