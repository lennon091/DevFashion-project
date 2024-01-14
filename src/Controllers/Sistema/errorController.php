<?php

namespace DevFashion\Src\Controllers\Sistema;

/**
 * Class errorController
 * @package DevFashion\Src\Controllers\Sistema
 * @version 1.0.0
 */
class errorController {

	/**
	 * Renderiza a view de página não encontrada
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function paginaNaoEncontrada(array $aDados): void {
		require_once "Sistema/notFound.php";
	}

	/**
	 * Renderiza a view de erros lançados por exceção
	 *
	 * @param array $aDados
	 * @param string $sMensagem
	 * @param int $iCodeExeption
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function errorExeption(array $aDados, string $sMensagem, int $iCodeExeption): void {
		require_once "Sistema/errorExeption.php";
	}
}