<?php

use DevFashion\Core\Functions;
use DevFashion\Src\Roupa\RoupaList;

/**
 * @var array $aDados
 * @var RoupaList $loRoupasMasculinas
 * @var RoupaList $loRoupasFemininas
 * @var RoupaList $loRoupasInfantis
 * @var RoupaList $loRoupasPlusSize
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

<?php require 'include/carrousel.php'?>

<section class="destaques">
	<h2>Produtos em Destaque</h2>
	<h3 class="produtos-container">Moda Masculina</h3>

	<?php
		foreach ($loRoupasMasculinas as $oRoupa) {
			Functions::imprimirCardRoupa($oRoupa);
		}
	?>
</section>

<section class="destaques">
	<h3 class="produtos-container">Moda Feminina</h3>

	<?php
		foreach ($loRoupasFemininas as $oRoupa) {
			Functions::imprimirCardRoupa($oRoupa);
		}
	?>
</section>

<section class="destaques">
	<h3 class="produtos-container">Moda Infantil</h3>

	<?php
		foreach ($loRoupasInfantis as $oRoupa) {
			Functions::imprimirCardRoupa($oRoupa);
		}
	?>
</section>

<section class="destaques">
	<h3 class="produtos-container">Moda Plus Size</h3>

	<?php
		foreach ($loRoupasPlusSize as $oRoupa) {
			Functions::imprimirCardRoupa($oRoupa);
		}
	?>
</section>

<?php Functions::renderFooter(); ?>
<?php Functions::addScript(["js/sistema/sistema.js"]); ?>
</body>