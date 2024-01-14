<?php

namespace DevFashion\Core;

/**
 * Class Session
 * @package DevFashion\Core
 * @version 1.0.0
 */
class Session {

	/**
	 * Verifica se a sessão foi iniciada, se não foi é iniciada uma sessão
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function iniciar(): void {
		session_start();
	}

	/**
	 * Retorna o Id do cliente logado
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function getClienteId(): int {
		self::iniciar();
		return $_SESSION['cle_id'];
	}

	/**
	 * Retorna se possui cliente logado
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function hasClienteLogado(): bool {
		self::iniciar();
		return !empty($_SESSION['cle_id']);
	}

	/**
	 * Atribui o Id do cliente na sessão
	 *
	 * @param int $iCleId
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function setClienteId(int $iCleId): void {
		self::iniciar();
		$_SESSION['cle_id'] = $iCleId;
	}

	public static function getMensagem(): string {
		self::iniciar();
		return $_SESSION['mensagem'];
	}

	public static function hasMensagem(): bool {
		self::iniciar();
		return !empty($_SESSION['mensagem']);
	}

	public static function setMensagem(string $sMensagem): void	{
		self::iniciar();
		$_SESSION['mensagem'] = $sMensagem;
	}

	public static function removerMensagem(): void {
		self::iniciar();
		unset($_SESSION['mensagem']);
	}

	/**
	 * Finaliza a sessão
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function destroy(): void {
		session_start();
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
	}
}