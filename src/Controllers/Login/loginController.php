<?php

namespace DevFashion\Src\Controllers\Login;

use DevFashion\Core\Session;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class loginController
 * @package DevFashion\Src\Controllers\Login
 * @version 1.0.0
 */
class loginController {

	/**
	 * Renderiza a view de login
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function index(array $aDados): void {
		require_once "Login/login.php";
	}

	/**
	 * Renderiza a view de cadastro
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function cadastro(array $aDados): void {
		require_once "Login/cadastro.php";
	}

	/**
	 * Realiza o login
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function logar(array $aDados): void {
		if (empty($aDados['cle_email']) || empty($aDados['cle_senha']) ) {
			header("location: ../../login");
		}

		try {
			$oCliente = Sistema::getClienteDAO()->findByEmail($aDados['cle_email']);
			if (!$oCliente->hasId()) {
				throw new \Exception("Falha ao logar. E-mail ou senha incorretos.");
			}

			if (!password_verify($aDados['cle_senha'],$oCliente->getSenha())) {
				throw new \Exception("Falha ao logar. E-mail ou senha incorretos.");
			}

			Session::setClienteId($oCliente->getId());
			header("location: ../../cliente/espaco");
		} catch (\Exception $oExp) {
			Session::setMensagem($oExp->getMessage());
			header("location: ../../login");
		}
	}

	/**
	 * Faz o logout do cliente logado
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function logout(array $aDados): void {
		Session::destroy();
		header("location: ../../home");
	}
}