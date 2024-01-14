<?php

namespace DevFashion\Src\Controllers\Home;

use DevFashion\Src\Sistema\Enum\TipoRoupaEnum;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class homeController
 * @package DevFashion\Src\Controllers\Home
 * @version 1.0.0
 */
class homeController {

	/**
	 * Renderiza a home page
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function index(array $aDados): void {
		$loRoupasMasculinas = Sistema::getRoupaDAO()->getRoupasByTipo(TipoRoupaEnum::MASCULINO,4);
		$loRoupasFemininas = Sistema::getRoupaDAO()->getRoupasByTipo(TipoRoupaEnum::FEMININO,4);
		$loRoupasInfantis = Sistema::getRoupaDAO()->getRoupasByTipo(TipoRoupaEnum::INFANTIL,4);
		$loRoupasPlusSize = Sistema::getRoupaDAO()->getRoupasByTipo(TipoRoupaEnum::PLUS_SIZE,4);

		require_once "Home/index.php";
	}
}