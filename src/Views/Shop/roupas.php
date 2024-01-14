<?php

use DevFashion\Core\Functions;
use DevFashion\Src\Roupa\RoupaList;

/**
 * @var array $aDados
 * @var string $sModa
 * @var RoupaList $loRoupas
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

<div class="lista-desejos">
	<h4><?php echo $sModa; ?></h4>
</div>

<section class="destaques">
	<?php
	foreach ($loRoupas as $oRoupa) {
		Functions::imprimirCardRoupa($oRoupa);
	}
	?>
</section>

<?php Functions::renderFooter(); ?>
<?php Functions::addScript(["js/sistema/sistema.js"]); ?>
</body>
</html>