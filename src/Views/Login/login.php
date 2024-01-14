<?php

use DevFashion\Core\Functions;
use DevFashion\Core\Session;

/**
 * @var array $aDados
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
		Functions::addStyleSheet(["css/Login/login.css"]);
	?>
</head>
<body>
<?php Functions::renderMenu($aDados); ?>

<main class="main_login_cadastro">
	<form class="custom-form" action="../../login/logar" id="login" type="post">
		<h2 class="mb-4 text-center">Login</h2>

		<?php if (Session::hasMensagem()) { ?>
			<div class="alert alert-warning" role="alert">
				<i class="fa-solid fa-triangle-exclamation"></i>
				<?php
					echo Session::getMensagem();
					Session::removerMensagem();
				?>
			</div>
		<?php } ?>

		<div class="form-group col" style="padding-bottom: 10px;">
			<label for="email" class="form-label mb-1"><b>Email</b></label>
			<input type="email" class="form-control" name="cle_email" id="email" placeholder="Digite seu Email" required>
		</div>

		<div class="form-group col" style="padding-bottom: 5px;">
			<label for="senha" class="form-label mb-1"><b>Senha</b></label>
			<input type="password" class="form-control" name="cle_senha" id="senha" placeholder="Digite sua Senha" required>
		</div>

		<div class="form-group mt-3 text-center d-grid gap-2 mx-auto">
			<button type="submit" class="btn btn-dark btn-md btn-block">Logar</button>
			<p class="mt-2 text-center">Não possui uma conta? <br><a href="../../login/cadastro">Cadastre-se aqui</a>.</p>
		</div>
	</form>
</main>

<?php Functions::renderFooter(); ?>
<?php Functions::addScript(["js/sistema/sistema.js"]); ?>
</body>
</html>