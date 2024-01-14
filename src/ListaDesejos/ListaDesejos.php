<?php

namespace DevFashion\Src\ListaDesejos;

use DevFashion\Src\Cliente\Cliente;
use DevFashion\Src\Roupa\Roupa;
use DevFashion\Src\Roupa\RoupaList;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class ListaDesejos
 * @package DevFashion\Src\ListaDesejos
 * @version 1.0.0
 */
class ListaDesejos {

	private int $iId;
	private Cliente $oCliente;
	
	/**
	 * Cria um objeto Lista Desejos a partir de um array
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return ListaDesejos
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function creteFromArray(array $aDados): ListaDesejos {
		$oListaDesejos = new ListaDesejos();
		$oListaDesejos->iId = $aDados['lss_id'];
		$oListaDesejos->oCliente = Sistema::getClienteDAO()->find($aDados['cle_id']);

		return $oListaDesejos;
	}

	/**
	 * Retorna o Id
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getId(): int {
		return $this->iId;
	}

	/**
	 * Atribui o Id
	 *
	 * @param int $iId
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setId(int $iId): void {
		$this->iId = $iId;
	}

	/**
	 * Retorna o cliente
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Cliente
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getCliente(): Cliente {
		return $this->oCliente;
	}

	/**
	 * Atribui o cliente
	 *
	 * @param Cliente $oCliente
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setCliente(Cliente $oCliente): void {
		$this->oCliente = $oCliente;
	}

	/**
	 * Cadastra uma lista de desejos
	 *
	 * @param Cliente $oCliente
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function cadastrar(Cliente $oCliente): void {
		$this->oCliente = $oCliente;
		Sistema::getListaDesejosDAO()->save($this);
	}

	/**
	 * Adiciona uma roupa a lista de desejos
	 *
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function adicionarRoupa(Roupa $oRoupa): void {
		Sistema::getListaDesejosDAO()->adicionarRoupa($this,$oRoupa);
	}

	/**
	 * Remove uma roupa da lista de desejos
	 *
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function removerRoupa(Roupa $oRoupa): void {
		Sistema::getListaDesejosDAO()->removerRoupa($this,$oRoupa);
	}

	/**
	 * Retorna as roupas da lista de desejos
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return RoupaList
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getRoupas(): RoupaList {
		return Sistema::getListaDesejosDAO()->getRoupas();
	}
}