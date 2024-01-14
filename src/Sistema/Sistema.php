<?php

namespace DevFashion\Src\Sistema;

use DevFashion\Src\Carrinho\CarrinhoDAO;
use DevFashion\Src\Cliente\ClienteDAO;
use DevFashion\Src\ListaDesejos\ListaDesejosDAO;
use DevFashion\Src\Pedido\PedidoDAO;
use DevFashion\Src\Roupa\RoupaDAO;
use DevFashion\Src\Sistema\Connection\Connection;
use DevFashion\Src\Sistema\Connection\ConnectionInterface;

/**
 * Class Sistema
 * @package DevFashion\Src\Sistema
 * @version 1.0.0
 */
class Sistema {

	/**
	 * Retorna a connection com o database
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return ConnectionInterface
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function connection(): ConnectionInterface {
		return new Connection();
	}

	/**
	 * Retorna o DAO de Cliente
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return ClienteDAO
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function getClienteDAO(): ClienteDAO {
		return new ClienteDAO();
	}

	/**
	 * Retorna o DAO de roupa
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return RoupaDAO
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function getRoupaDAO(): RoupaDAO {
		return new RoupaDAO();
	}

	/**
	 * Retorna o DAo de Carrinho
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return CarrinhoDAO
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function getCarrinhoDAO(): CarrinhoDAO {
		return new CarrinhoDAO();
	}

	/**
	 * Retorna o DAO da lista de desejos
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return ListaDesejosDAO
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function getListaDesejosDAO(): ListaDesejosDAO {
		return new ListaDesejosDAO();
	}

	/**
	 * Retorna o DAO de pedido
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return PedidoDAO
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function getPedidoDAO(): PedidoDAO {
		return new PedidoDAO();
	}
}