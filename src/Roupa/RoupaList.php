<?php

namespace DevFashion\Src\Roupa;

/**
 * Class RoupaList
 * @package DevFashion\Src\Roupa
 * @version 1.0.0
 */
class RoupaList extends \SplObjectStorage {

	/**
	 * Cria uma lista de roupa a partir de um array
	 *
	 * @param array $aaRoupas
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return RoupaList
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function createFromArray(array $aaRoupas): RoupaList {
		$loRoupaList = new RoupaList();

		foreach ($aaRoupas as $aRoupa) {
			$oRoupa = Roupa::createFromArray($aRoupa);
			$loRoupaList->attach($oRoupa);
		}

		return $loRoupaList;
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

	/**
	 * Retorna o valor total das roupas
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getValorTotalRoupas(): string {
		$fValor = 0.0;

		/** @var Roupa $oRoupa */
		foreach ($this as $oRoupa) {
			$fValor += $oRoupa->getPreco();
		}

		return "R$ " . number_format($fValor,2,",",".");
	}

	/**
	 * Retorna o valor total das roupas sem formatacao
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return float
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getValorTotalSemFormatacao(): float	{
		$fValor = 0.0;

		/** @var Roupa $oRoupa */
		foreach ($this as $oRoupa) {
			$fValor += $oRoupa->getPreco();
		}

		return $fValor;
	}
}