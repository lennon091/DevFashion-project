<?php

use DevFashion\Core\Functions;
use DevFashion\Src\Roupa\Roupa;
use DevFashion\Src\Roupa\RoupaList;

/**
 * @var array $aDados
 * @var RoupaList $loRoupas
 * @var Roupa $oRoupa
 */

$sDisabled = $loRoupas->isEmpty() ? "disabled" : "";
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
		Functions::addStyleSheet(["css/style.css"]);
	?>
</head>
<body>
<?php Functions::renderMenu($aDados); ?>

<div class="lista-desejos">
	<h4>Carrinho</h4>
</div>

<?php if ($loRoupas->isEmpty()) { ?>
	<div class="lista-desejos-vazia">
		<div>
			<svg xmlns="http://www.w3.org/2000/svg" height="3em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
			<p>Você ainda não possui itens no seu carrinho.</p>
		</div>
	</div>
<?php } else { ?>
	<div class="content-carrinho">
		<form method="post" action="../../shop/pagamento">
			<input type="hidden" name="tela_pagamento" value="1">
			<table class="cart-table">
				<thead>
					<tr>
						<th class="table-head-item first-col">Item</th>
						<th class="table-head-item second-col">Preço</th>
						<th class="table-head-item third-col">Quantidade</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($loRoupas as $oRoupa) { ?>
						<tr class="cart-product" id="<?php echo $oRoupa->getId(); ?>">
							<input type="hidden" name="aRpaId[]" value="<?php echo $oRoupa->getId(); ?>">
							<td class="product-identification">
								<?php Functions::addImage($oRoupa->getCaminhoImagem(),"jpg","#","","cart-product-image"); ?>
								<span class="cart-product-title"><?php echo $oRoupa->getNome(); ?></span>
							</td>
							<td>
								<span class="cart-product-price"><?php echo $oRoupa->getDescricaoPreco() ?></span>
							</td>
							<td>
								<input type="text" value="1" min="1" class="product-qtd-input" readonly>
								<button type="button" class="remove-product-button">Remover</button>
							</td>
						</tr>
					<?php } ?>
				</tbody>

				<tfoot>
					<tr>
						<td colspan="3" class="cart-total-container">
							<strong>Total</strong>
							<span><?php echo $loRoupas->getValorTotalRoupas(); ?></span>
						</td>
					</tr>
				</tfoot>
			</table>

			<button type="submit" class="purchase-button" <?php echo $sDisabled; ?>>Finalizar Compra</button>
		</form>
	</div>
<?php } ?>

<?php Functions::renderFooter(); ?>
<?php Functions::addScript(["js/sistema/sistema.js", "js/Carrinho/carrinho.js"]); ?>

</body>
</html>