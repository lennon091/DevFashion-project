<?php

namespace DevFashion\Src\Pedido;

use DevFashion\Src\Cliente\Cliente;
use DevFashion\Src\Roupa\RoupaList;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class PedidoDAO
 * @package DevFashion\Src\Pedido
 * @version 1.0.0
 */
class PedidoDAO {

	/**
	 * Cadastra um pedido
	 *
	 * @param Pedido $oPedido
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function cadastrar(Pedido $oPedido): void {
		$oConnection = Sistema::connection();
		$sSQL = "insert into pdo_pedido (pdo_valor, pdo_data_pedido, cle_id) values (?,?,?)";
		$aParams = [
			$oPedido->getValorPedido(),
			$oPedido->getDataPedido()->format("Y-m-d"),
			$oPedido->getCliente()->getId()
		];

		try {
			$oConnection->execute($sSQL,$aParams);
			$oPedido->setId($oConnection->getLasInsertId());
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível cadastrar o pedido.");
		}

		foreach ($oPedido->getRoupas() as $oRoupa) {
			$sSQL = "insert into rpo_roupa_pedido (rpa_id, pdo_id) values (?,?)";
			$aParams = [$oRoupa->getId(),$oPedido->getId()];

			try {
				$oConnection->execute($sSQL,$aParams);
			} catch (\PDOException $oExp) {
				throw new \Exception("Não foi possível cadastrar o pedido.");
			}
		}
	}

	/**
	 * Consulta os pedidos com base no cliente
	 *
	 * @param Cliente $oCliente
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return PedidoList
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function findByCliente(Cliente $oCliente): PedidoList {
		$sSQL = "SELECT * FROM pdo_pedido where cle_id = ?";
		$aParam[] = $oCliente->getId();

		try {
			$aaPedidos = Sistema::connection()->getArray($sSQL,$aParam);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível consultar os pedidos.");
		}

		if (empty($aaPedidos)) {
			return new PedidoList();
		}

		return PedidoList::createFromArray($aaPedidos);
	}

	/**
	 * Retorna a quantidade de roupas no pedido
	 *
	 * @param Pedido $oPedido
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return int
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getQuantidadeRoupas(Pedido $oPedido): int {
		$sSQl = "select count(pdo_id) from rpo_roupa_pedido where pdo_id = ?";
		$aParam[] = $oPedido->getId();

		try {
			$aRetorno = Sistema::connection()->getRow($sSQl,$aParam);
			return intval($aRetorno[0]);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível consultar o pedido.");
		}
	}
}