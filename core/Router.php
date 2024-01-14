<?php

namespace DevFashion\Core;

use DevFashion\Src\Controllers\Sistema\errorController;

/**
 * Class Router
 * @package DevFashion\Core
 * @version 1.0.0
 */
class Router {

	private array $aDados;

	/**
	 * Router Construtor
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function __construct() {
		Session::iniciar();
		$this->attrValues();
	}

	/**
	 * Inicia a rota
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function iniciar(): void {
		$oController = $this->getController();
		$oErroController = new errorController();

		try {
			$sAcao = $this->aDados['acao'];
			if (!method_exists($oController,$sAcao)) {
				$oErroController->paginaNaoEncontrada($this->aDados);
				exit();
			}

			$oController->$sAcao($this->aDados);
		} catch (\Exception $oExp) {
			$oErroController->errorExeption($this->aDados, $oExp->getMessage(), $oExp->getCode());
			exit();
		} catch (\Throwable $oExp) {
			$sMensagem = 'Desculpe, ocorreu um erro inesperado.';

			if ($oExp instanceof \TypeError) {
				$sMensagem = 'Ops! Houve um problema com o tipo de dado fornecido. Verifique os campos.';
			}

			$oErroController->errorExeption($this->aDados, $sMensagem, $oExp->getCode());
			exit();
		}
	}

	/**
	 * Atribui os valores
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	private function attrValues(): void {
		$_GET['modulo'] = filter_input(INPUT_GET,"modulo",FILTER_SANITIZE_URL) ?? "home";
		$_GET['acao'] = filter_input(INPUT_GET,"acao",FILTER_SANITIZE_URL) ?? "index";
		$_GET['valor'] = filter_input(INPUT_GET,'valor',FILTER_SANITIZE_URL) ?? null;

		$this->aDados = array_merge($_GET,$_POST,$_FILES);
	}

	/**
	 * Retorna a controladora
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return mixed
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	private function getController(): mixed {
		$sController = ucfirst($this->aDados['modulo']) . "\\{$this->aDados['modulo']}Controller";
		$oControllerClass = "DevFashion\\Src\\Controllers\\$sController";

		if (!class_exists($oControllerClass)) {
			$oErroController = new errorController();
			$oErroController->paginaNaoEncontrada($this->aDados);
			exit();
		}

		return new $oControllerClass();
	}
}