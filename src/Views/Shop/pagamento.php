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
	<h4>Pagamento</h4>
</div>

<div class="content-pagamento">
	<div class="valor-total">Valor Total: <b><?php echo $loRoupas->getValorTotalRoupas(); ?></b></div>
	<form id="payment-form" method="post" action="../../cliente/cadastrarPedido">
		<input type="hidden" name="sRpaId" value="<?php echo implode(",",$aDados['aRpaId']); ?>">
		<input type="hidden" name="pdo_valor" value="<?php echo $loRoupas->getValorTotalSemFormatacao(); ?>">

		<div class="form-group">
			<label for="card-number">Número do Cartão:</label>
			<input type="text" id="card-number" placeholder="1234 5678 9012 3456" maxlength="19" oninput="validarNumero(this)" required>
		</div>

		<div class="form-group">
			<label for="expiry">Data de Expiração:</label>
			<input type="text" id="expiry" placeholder="MM/YY" maxlength="5" oninput="validarNumero(this)" required>
		</div>

		<div class="form-group">
			<label for="cvv">CVV:</label>
			<input type="text" id="cvv" placeholder="123" maxlength="3" oninput="validarNumero(this)" required>
		</div>

		<div class="form-group">
			<label for="name">Nome no Cartão:</label>
			<input type="text" id="name" placeholder="Seu Nome" required>
		</div>

		<div style="padding-top: 10px">
			<input type="submit" value="Pagar">
		</div>
	</form>
</div>

<?php Functions::renderFooter(); ?>
<?php Functions::addScript(["js/sistema/sistema.js"]); ?>

<script>
	function validarNumero(input) {
		input.value = input.value.replace(/[^0-9]/g, '');
	}

	const cardNumber = document.getElementById('card-number');
	cardNumber.addEventListener('input', function (e) {
		const value = e.target.value.replace(/\D/g, '');
		const formattedValue = value.match(/.{1,4}/g).join(' ');
		e.target.value = formattedValue;
	});

	const dateInput = document.getElementById("expiry");

	dateInput.addEventListener("input", function() {
		const value = dateInput.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
		if (value.length >= 2) {
			const formattedValue = value.substr(0, 2) + '/' + value.substr(2, 4);
			dateInput.value = formattedValue;
		}
	});
</script>
</body>
</html>