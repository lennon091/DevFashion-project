<?php

namespace DevFashion\Src\ListaDesejos;

use DevFashion\Src\Cliente\Cliente;
use DevFashion\Src\Roupa\Roupa;
use DevFashion\Src\Roupa\RoupaList;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class ListaDesejosDAO
 * @package DevFashion\Src\ListaDesejos
 * @version 1.0.0
 */
class ListaDesejosDAO {

	/**
	 * Retorna se possui roupa a roupa na lista de desejo
	 *
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function hasRoupaNaLista(Roupa $oRoupa): bool {
		$sSQL = "SELECT * FROM lsa_lista_desejos_cliente where rpa_id = ?";
		$aParam[] = $oRoupa->getId();

		try {
			$aLista = Sistema::connection()->getArray($sSQL,$aParam);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível consultar a roupa da lista de desejos.");
		}

		return !empty($aLista[0]);
	}

	/**
	 * Retorna se o cliente possui lista de desejos
	 *
	 * @param Cliente $oCliente
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function hasListaDesejos(Cliente $oCliente): bool {
		$sSQL = "SELECT * FROM lss_lista_desejos where cle_id = ?";
		$aParam[] = $oCliente->getId();

		try {
			$aLista = Sistema::connection()->getArray($sSQL,$aParam);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível consultar a roupa da lista de desejos.");
		}

		return !empty($aLista[0]);
	}

	/**
	 * Salva uma lista de desejos
	 *
	 * @param ListaDesejos $oListaDesejos
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function save(ListaDesejos $oListaDesejos): void {
		$oConnection = Sistema::connection();
		$sSQL = "insert into lss_lista_desejos (cle_id) values (?)";
		$aParam[] = $oListaDesejos->getCliente()->getId();

		try {
			$oConnection->execute($sSQL,$aParam);
			$oListaDesejos->setId($oConnection->getLasInsertId());
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível criar a lista de desejos.");
		}
	}

	/**
	 * Retorna a lista de desejos do cliente
	 *
	 * @param Cliente $oCliente
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return ListaDesejos
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function findByCliente(Cliente $oCliente): ListaDesejos {
		$sSQL = "SELECT * FROM lss_lista_desejos where cle_id = ?";
		$aParam[] = $oCliente->getId();
		
		try {
			$aLista = Sistema::connection()->getRow($sSQL,$aParam);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível consultar a roupa da lista de desejos.");
		}

		if (empty($aLista)) {
			throw new \Exception("Lista de desejos não encontrada.");
		}

		return ListaDesejos::creteFromArray($aLista);
	}

	/**
	 * Adiciona uma roupa a lista de desejos
	 *
	 * @param ListaDesejos $oListaDesejos
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function adicionarRoupa(ListaDesejos $oListaDesejos, Roupa $oRoupa): void {
		$sSQL = "insert into lsa_lista_desejos_cliente (lss_id, rpa_id) values (?,?)";
		$aParams = [$oListaDesejos->getId(),$oRoupa->getId()];

		try {
			Sistema::connection()->execute($sSQL,$aParams);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível adicionar a roupa à lista de desejos.");
		}
	}

	/**
	 * Remove uma roupa da lista de desejos
	 *
	 * @param ListaDesejos $oListaDesejos
	 * @param Roupa $oRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function removerRoupa(ListaDesejos $oListaDesejos, Roupa $oRoupa): void {
		$sSQL = "delete From lsa_lista_desejos_cliente where lss_id = ? and rpa_id = ?";
		$aParams = [$oListaDesejos->getId(),$oRoupa->getId()];

		try {
			Sistema::connection()->execute($sSQL,$aParams);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível remover a roupa da lista de desejos.");
		}
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
		$sSQL = "select
					rpa.*
				from rpa_roupa rpa
				inner join lsa_lista_desejos_cliente lss on rpa.rpa_id = lss.rpa_id";

		try {
			$aaRoupas = Sistema::connection()->getArray($sSQL);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível consultar a roupa da lista de desejos.");
		}

		if (empty($aaRoupas)) {
			return new RoupaList();
		}

		return RoupaList::createFromArray($aaRoupas);
	}
}