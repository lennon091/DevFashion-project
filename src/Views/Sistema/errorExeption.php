<?php

use DevFashion\Core\Functions;

/**
 * @var array $aDados
 * @var string $sMensagem
 * @var int $iCodeExeption
 */
?>

<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<title>DevFashion</title>
	<?php
		Functions::addFavicon();
		Functions::addStyleSheet();
	?>
</head>
<body>
<?php Functions::renderMenu($aDados); ?>

<div class="d-flex align-items-center justify-content-center vh-100">
	<div class="text-center">
		<h1 class="display-1 fw-bold"><?php echo $iCodeExeption; ?></h1>
		<p class="fs-3"> <span class="text-danger">Opps!</span> Ocorreu um erro</p>
		<p class="lead">
			<?php echo $sMensagem; ?>
		</p>
		<a href="../../home" class="btn btn-secondary">Home</a>
	</div>
</div>

<?php Functions::renderFooter(); ?>
<?php Functions::addScript(["js/sistema/sistema.js"]); ?>
</body>
</html>