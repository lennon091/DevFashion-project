<?php

namespace DevFashion\Src\Pedido;

use DevFashion\Src\Cliente\Cliente;
use DevFashion\Src\Roupa\RoupaList;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class Pedido
 * @package DevFashion\Src\Pedido
 * @version 1.0.0
 */
class Pedido {

	private int $iId;
	private float $fValorPedido;
	private \DateTimeImmutable $oDataPedido;
	private Cliente $oCliente;
	private RoupaList $loRoupas;

	/**
	 * Cria um objeto pedido a partir de um array
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Pedido
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function createFromArray(array $aDados): Pedido {
		$oPedido = new Pedido();
		$oPedido->iId = $aDados['pdo_id'];
		$oPedido->fValorPedido = $aDados['pdo_valor'];
		$oPedido->oDataPedido = new \DateTimeImmutable($aDados['pdo_data_pedido']);
		$oPedido->oCliente = Sistema::getClienteDAO()->find($aDados['cle_id']);

		return $oPedido;
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
	 * Atribui o id
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
	 * Retorna o valor
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return float
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getValorPedido(): float {
		return $this->fValorPedido;
	}
	
	/**
	 * Retorna a descrição do valor do pedido
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getDescricaoValor(): string {
		return "R$ " . number_format($this->fValorPedido,2,",",".");
	}

	/**
	 * Atribui o valor
	 *
	 * @param float $fValorPedido
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setValorPedido(float $fValorPedido): void {
		$this->fValorPedido = $fValorPedido;
	}

	/**
	 * Retorna a data do pedido
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return \DateTimeImmutable
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getDataPedido(): \DateTimeImmutable {
		return $this->oDataPedido;
	}

	/**
	 * Atribui a data do pedido
	 *
	 * @param \DateTimeImmutable $oDataPedido
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setDataPedido(\DateTimeImmutable $oDataPedido): void {
		$this->oDataPedido = $oDataPedido;
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
	 * Retorna as roupas do pedido
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return RoupaList
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getRoupas(): RoupaList {
		return $this->loRoupas;
	}

	/**
	 * Adiciona as roupas ao pedido
	 *
	 * @param RoupaList $loRoupas
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setRoupas(RoupaList $loRoupas): void {
		$this->loRoupas = $loRoupas;
	}

	/**
	 * Cadastra um pedido
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function cadastrar(): void {
		$this->validarDadosPreenchidos();
		$this->oDataPedido = new \DateTimeImmutable("now");

		Sistema::getPedidoDAO()->cadastrar($this);
	}

	/**
	 * Valida se os dados do pedido foram preenchidos
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	private function validarDadosPreenchidos(): void {
		if (empty($this->oCliente) || empty($this->fValorPedido) || $this->loRoupas->isEmpty()) {
			throw new \Exception("Não é possível fazer um pedido sem roupas ou com o valor zerado.");
		}
	}

	/**
	 * Retorna a quantidade de roupas no pedido
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return int
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getQuantidadeRoupas(): int {
		return Sistema::getPedidoDAO()->getQuantidadeRoupas($this) ?? 0;
	}
}