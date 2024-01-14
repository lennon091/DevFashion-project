<?php

namespace DevFashion\Src\Pedido;

use DevFashion\Src\Roupa\Roupa;
use DevFashion\Src\Roupa\RoupaList;

/**
 * Class PedidoList
 * @package DevFashion\Src\Pedido
 * @version 1.0.0
 */
class PedidoList extends \SplObjectStorage {

	/**
	 * Cria uma lista de pedido a partir de um array
	 *
	 * @param array $aaRoupas
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return PedidoList
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function createFromArray(array $aaRoupas): PedidoList {
		$loPedidoList = new PedidoList();

		foreach ($aaRoupas as $aRoupa) {
			$oRoupa = Pedido::createFromArray($aRoupa);
			$loPedidoList->attach($oRoupa);
		}

		return $loPedidoList;
	}

	/**
	 * Retorna se a lista está vazia
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function isEmpty(): bool {
		return $this->count() == 0;
	}
}