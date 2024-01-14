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

<?php if (Session::hasMensagem()) { ?>
	<div style="width: 60%; margin: 0 auto;">
		<div class="alert alert-warning" role="alert">
			<i class="fa-solid fa-triangle-exclamation"></i>
			<?php
				echo Session::getMensagem();
				Session::removerMensagem();
			?>
		</div>
	</div>
<?php } ?>

<main class="main_login_cadastro">
	<form class="custom-form" id="cadastro" name="formC" action="../../cliente/cadastrar" method="post">
		<h2 class="mb-4 text-center">Cadastre-se</h2>
		<div>
			<h4>Dados Pessoais<em style="color: red">*</em></h4>
		</div>

		<div class="row g-3 mb-2">
			<div class="col">
				<label for="nome" class="form-label mb-1">Nome Completo</label>
				<input type="text" class="form-control" id="nome" placeholder="Nome" maxlength="100" name="cle_nome" required>
			</div>
		</div>

		<div class="row mb-2">
			<div class="col-md-6">
				<label for="cpf" class="form-label mb-1">CPF</label>
				<input type="text" class="form-control" onblur="TestaCPF(numeroCpf.value.replaceAll('.', '').replace('-', '').replace('-', ''))" id="cpf" placeholder="CPF" name="cle_cpf" required maxlength="14">
				<div id="msgCpf"></div>
			</div>

			<div class="col-md-6">
				<label for="telefone" class="form-label mb-1">Número de Telefone</label>
				<input type="tel" class="form-control" id="telefone" maxlength="11" placeholder="(xx) xxxxx-xxxx" name="cle_telefone" required>
			</div>
		</div>

		<div class="mb-2">
			<label for="email" class="form-label mb-1">Email</label>
			<input type="email" class="form-control" id="email" onblur="validacaoEmail(formC.email)" placeholder="Email" maxlength="50" name="cle_email" required>
			<div id="msgemail"></div>
		</div>

		<div class="row mb-2">
			<div class="col-md-6">
				<label for="senha" class="form-label mb-1">Senha</label>
				<input type="password" class="form-control" id="senha" placeholder="Senha" maxlength="50" name="cle_senha" required>
			</div>

			<div class="col-md-6">
				<label for="confirmarSenha" class="form-label mb-1">Confirmar Senha</label>
				<input type="password" class="form-control" id="confirmarSenha" placeholder="Confirme sua senha" maxlength="50" onblur="validarSenha()" required>
			</div>
			<div class="text-center" id="senhaErr"></div>
		</div>

		<div class="row g-3">
			<div class="col-md-6">
				<label for="dataNascimento" class="form-label mb-1">Data de Nascimento</label>
				<input type="date" class="form-control" id="dataNascimento" name="cle_data_nascimento" required>
			</div>

			<div class="col-md-6 mb-3">
				<label for="sexo" class="form-label mb-1">Sexo</label>
				<select id="sexo" class="form-select" name="cle_sexo" required>
					<option value="1">Masculino</option>
					<option value="2">Feminino</option>
					<option value="3">Outro</option>
				</select>
			</div>
		</div>

		<div>
			<h4>Endereço<em style="color: red">*</em></h4>
		</div>

		<div class="row g-3 mb-2 align-items-center">
			<div class="col-3">
				<label for="cep" class="form-label">CEP</label>
				<input type="text" class="form-control" id="cep" maxlength="8" name="cle_cep" placeholder="CEP" required>
				<div id="cepErr"></div>
			</div>
	
			<div class="col-2">
				<label for="uf" class="form-label">UF</label>
				<input type="text" class="form-control" id="uf" maxlength="50" name="cle_estado" placeholder="UF" required>
			</div>
	
			<div class="col">
				<label for="cidade" class="form-label">Cidade</label>
				<input type="text" class="form-control" id="cidade" maxlength="50" name="cle_cidade" placeholder="Cidade" required>
			</div>
		</div>

		<div class="row g-3 mb-2">
			<div class="col-md-8">
				<label for="logradouro" class="form-label">Logradouro</label>
				<input type="text" class="form-control" id="logradouro" maxlength="100" name="cle_logradouro" placeholder="Logradouro" required>
			</div>

			<div class="col-md-4">
				<label for="numero" class="form-label">Número</label>
				<input type="text" class="form-control" id="numero" maxlength="50" name="cle_numero" placeholder="Número" required>
			</div>
		</div>

		<div class="mb-2">
			<label for="bairro" class="form-label">Bairro</label>
			<input type="text" class="form-control" id="bairro" maxlength="50" name="cle_bairro" placeholder="Bairro" required>
		</div>

		<div class="mb-2">
			<label for="complemento" class="form-label">Complemento</label>
			<input type="text" class="form-control" id="complemento" maxlength="100" name="cle_complemento" placeholder="Complemento">
		</div>

			<div class="form-group mt-3 text-center d-grid gap-2 mx-auto">
				<button type="submit" onclick="return validarForm()" class="btn btn-dark btn-md btn-block">Cadastrar</button>
				<p class="text-center mt-2">Já possui uma conta? Faça <a href="../../login">login aqui</a>.</p>
			</div>
	</form>
</main>

<?php Functions::renderFooter(); ?>
<?php Functions::addScript(["js/sistema/sistema.js","js/Login/script_cadastro.js"]); ?>
</body>
</html>