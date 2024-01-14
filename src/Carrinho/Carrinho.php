<?php

namespace DevFashion\Src\Carrinho;

use DevFashion\Src\Cliente\Cliente;
use DevFashion\Src\Roupa\Roupa;
use DevFashion\Src\Roupa\RoupaList;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class Carrinho
 * @package DevFashion\Src\Carrinho
 * @version 1.0.0
 */
class Carrinho {

	private int $iId;
	private Cliente $oCliente;

	/**
	 * Cria um objeto Carrinho a partir de um array
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Carrinho
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function createFromArray(array $aDados): Carrinho {
		$oCarrinho = new Carrinho();
		$oCarrinho->iId = $aDados['cro_id'];
		$oCarrinho->oCliente = Sistema::getClienteDAO()->find($aDados['cle_id']);

		return $oCarrinho;
	}

	/**
	 * Retorna o Id do carrinho
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
	 * Retorna as roupas que estão no carrinho
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return RoupaList
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getRoupas(): RoupaList {
		return Sistema::getCarrinhoDAO()->getRoupasNoCarrinho($this);
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
	 * Adiciona uma roupa ao carrinho
	 *
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function adicionarRoupa(Roupa $oRoupa): void {
		Sistema::getCarrinhoDAO()->adicionarRoupa($this,$oRoupa);
	}

	/**
	 * Remove a roupa do carrinho
	 *
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function removerRoupa(Roupa $oRoupa): void {
		Sistema::getCarrinhoDAO()->removerRoupa($this,$oRoupa);
	}

	/**
	 * Cadastra o carrinho
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
		Sistema::getCarrinhoDAO()->save($this);
	}

	/**
	 * Retorna a quantidade de roupas no carrinho
	 *
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function hasRoupa(Roupa $oRoupa): bool {
		return Sistema::getCarrinhoDAO()->hasRoupa($this,$oRoupa);
	}

	/**
	 * Limpa o carrinho após cadastrar o pedido
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function limpar(): void {
		Sistema::getCarrinhoDAO()->limpar($this);
	}
}