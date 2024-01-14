<?php

namespace DevFashion\Src\Carrinho;

use DevFashion\Src\Cliente\Cliente;
use DevFashion\Src\Roupa\Roupa;
use DevFashion\Src\Roupa\RoupaList;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class CarrinhoDAO
 * @package DevFashion\Src\Carrinho
 * @version 1.0.0
 */
class CarrinhoDAO {

	/**
	 * Retorna as roupas que estão no carrinho
	 *
	 * @param Carrinho $oCarrinho
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return RoupaList
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getRoupasNoCarrinho(Carrinho $oCarrinho): RoupaList {
		$sSql = "SELECT
					rpa.*
				FROM
					rpa_roupa rpa
				INNER JOIN cra_carrinho_roupa cra ON rpa.rpa_id = cra.rpa_id
				WHERE
					cra.cro_id = ?";
		$aParam[] = $oCarrinho->getId();

		try {
			$aaRoupas = Sistema::connection()->getArray($sSql,$aParam);
		} catch (\PDOException $oExp) {
			throw new \PDOException("Não foi possível consultar as roupas do carrinho.");
		}

		if (empty($aaRoupas)) {
			return new RoupaList();
		}

		return RoupaList::createFromArray($aaRoupas);
	}

	/**
	 * Adiciona uma roupa ao carrinho
	 *
	 * @param Carrinho $oCarrinho
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function adicionarRoupa(Carrinho $oCarrinho, Roupa $oRoupa): void {
		$sSql = "INSERT INTO cra_carrinho_roupa (cro_id, rpa_id) VALUES (?,?)";
		$aParams = [$oCarrinho->getId(),$oRoupa->getId()];

		try {
			Sistema::connection()->execute($sSql,$aParams);
		} catch (\PDOException $oExp) {
			throw new \PDOException("Não foi possível adicionar a roupa ao carrinho.");
		}
	}

	/**
	 * Retorna o carrinho conforme o Id do cliente
	 *
	 * @param Cliente $oCliente
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Carrinho
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function findByCliente(Cliente $oCliente): Carrinho {
		$sSQL = "select * from cro_carrinho where cle_id = ?";
		$aParam[] = $oCliente->getId();

		try {
			$aCarrinho = Sistema::connection()->getRow($sSQL,$aParam);
		} catch (\PDOException) {
			throw new \Exception("Não foi possível consultar o carrinho.");
		}

		if (empty($aCarrinho)) {
			throw new \Exception("Nenhum carrinho encontrado.");
		}

		return Carrinho::createFromArray($aCarrinho);
	}

	/**
	 * Retorna se o cliente possui carrinho
	 *
	 * @param Cliente $oCliente
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function hasCarrinho(Cliente $oCliente): bool {
		$sSQL = "select * from cro_carrinho where cle_id = ?";
		$aParam[] = $oCliente->getId();

		try {
			$aCarrinho = Sistema::connection()->getRow($sSQL,$aParam);
		} catch (\PDOException) {
			throw new \Exception("Não foi possível consultar o carrinho.");
		}

		return !empty($aCarrinho['cro_id']);
	}

	/**
	 * Cadastra um carrinho
	 *
	 * @param Carrinho $oCarrinho
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function save(Carrinho $oCarrinho): void {
		$oConnection = Sistema::connection();
		$sSQL = "insert into cro_carrinho (cle_id) values (?)";
		$aParam[] = $oCarrinho->getCliente()->getId();

		try {
			$oConnection->execute($sSQL,$aParam);
			$oCarrinho->setId($oConnection->getLasInsertId());
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível criar a lista de desejos.");
		}
	}

	/**
	 * Retorna se uma roupa está no carrinho
	 *
	 * @param Carrinho $oCarrinho
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function hasRoupa(Carrinho $oCarrinho, Roupa $oRoupa): bool {
		$sSQL = "SELECT rpa.* FROM rpa_roupa rpa
				INNER JOIN cra_carrinho_roupa cra on rpa.rpa_id = cra.rpa_id and cra.cro_id = ?
				WHERE
					rpa.rpa_id = ?";
		$aParams = [$oCarrinho->getId(),$oRoupa->getId()];
		
		try {
			$aRoupa = Sistema::connection()->getRow($sSQL,$aParams);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível consultar a roupa.");
		}

		return !empty($aRoupa['rpa_id']);
	}

	/**
	 * Remove a roupa do carrinho
	 *
	 * @param Carrinho $oCarrinho
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function removerRoupa(Carrinho $oCarrinho, Roupa $oRoupa): void {
		$sSql = "DELETE FROM cra_carrinho_roupa where cro_id = ? and rpa_id = ?";
		$aParams = [$oCarrinho->getId(),$oRoupa->getId()];

		try {
			Sistema::connection()->execute($sSql,$aParams);
		} catch (\PDOException $oExp) {
			throw new \PDOException("Não foi possível remover a roupa do carrinho.");
		}
	}

	/**
	 * Limpa o carrinho após cadastrar o pedido
	 *
	 * @param Carrinho $oCarrinho
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function limpar(Carrinho $oCarrinho): void {
		$sSql = "DELETE FROM cra_carrinho_roupa where cro_id = ?";
		$aParam[] = $oCarrinho->getId();

		try {
			Sistema::connection()->execute($sSql,$aParam);
		} catch (\PDOException $oExp) {
			throw new \PDOException("Não foi possível remover a roupa do carrinho.");
		}
	}
}