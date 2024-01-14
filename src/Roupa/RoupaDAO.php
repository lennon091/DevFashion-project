<?php

namespace DevFashion\Src\Roupa;

use DevFashion\Src\Sistema\Sistema;

/**
 * Class RoupaDAO
 * @package DevFashion\Src\Roupa
 * @version 1.0.0
 */
class RoupaDAO {

	/**
	 * Retorna as roupas com base no tipo
	 *
	 * @param int $iTipoRoupa
	 * @param int|null $iLimit
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return RoupaList
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getRoupasByTipo(int $iTipoRoupa, int $iLimit = null): RoupaList {
		$sLimit = "";
		if ($iLimit) {
			$sLimit = "limit $iLimit";
		}

		$sSql = "SELECT * FROM rpa_roupa WHERE rpa_tipo = ? $sLimit";
		$aParam[] = $iTipoRoupa;

		try {
			$aaRoupas = Sistema::connection()->getArray($sSql,$aParam);
		} catch (\PDOException $oExp) {
			throw new \PDOException("Não foi possível consultar as roupas.");
		}

		if (empty($aaRoupas)) {
			return new RoupaList();
		}

		return RoupaList::createFromArray($aaRoupas);
	}

	/**
	 * Consulta a roupa com base no Id
	 *
	 * @param int $iRpaId
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Roupa
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function find(int $iRpaId): Roupa {
		$sSQL = "SELECT * FROM rpa_roupa where rpa_id = ?";
		$aParam[] = $iRpaId;

		try {
			$aRoupa = Sistema::connection()->getRow($sSQL,$aParam);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível consultar a roupa.");
		}

		if (empty($aRoupa)) {
			throw new \Exception("Nenhuma roupa encontrada.",404);
		}

		return Roupa::createFromArray($aRoupa);
	}
}