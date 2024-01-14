<?php

use DevFashion\Core\Functions;
use DevFashion\Src\Roupa\Roupa;

/**
 * @var array $aDados
 * @var Roupa $oRoupa
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

<div class="content-visualizar-roupa">
	<div class="imagem">
		<?php Functions::addImage($oRoupa->getCaminhoImagem(),"jpg","#"); ?>
	</div>

	<div class="informacao-principal">
		<div class="inform">
			<div class="nome-roupa">
				<h2><?php echo $oRoupa->getNome(); ?></h2>
			</div>
			<div class="tamanho-categoria">
				<p class="cat">Selecione a opção de <b class="cor-secundaria">TAMANHO</b>:</p>
				<ul class="cat-tamanho">
					<li>P</li>
					<li>M</li>
					<li>G</li>
					<li>GG</li>
				</ul>
			</div>
			<div class="valores">
				<h2 class="valor-principal"><?php echo $oRoupa->getDescricaoPreco() ?></h2>
				<h3 class="valor-div"><?php echo $oRoupa->getDescricaoParcelamento() ?></h3>
			</div>
			<div class="comprar">
				<button class="btn_add_roupa buy" data-id="<?php echo $oRoupa->getId(); ?>">
					<i class="fas fa-shopping-cart"></i>
					Adicionar ao carrinho
				</button>
			</div>
		</div>
	</div>
</div>

<?php Functions::renderFooter(); ?>
<?php Functions::addScript(["js/sistema/sistema.js"]); ?>

<script>
	const TamanhoItens = document.querySelectorAll('.cat-tamanho li');

	TamanhoItens.forEach(item => {
		item.addEventListener('click', () => {
			TamanhoItens.forEach(i => i.classList.remove('selecionado'));
			item.classList.add('selecionado');
		});
	});


</script>
</body>
</html>