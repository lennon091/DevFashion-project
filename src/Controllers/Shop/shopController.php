<?php

namespace DevFashion\Src\Controllers\Shop;

use DevFashion\Core\Session;
use DevFashion\Src\Sistema\Enum\TipoRoupaEnum;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class shopController
 * @package DevFashion\Src\Controllers\Shop
 * @version 1.0.0
 */
class shopController {

	/**
	 * Renderiza a tela das roupas masculina
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function masculino(array $aDados): void {
		$loRoupas = Sistema::getRoupaDAO()->getRoupasByTipo(TipoRoupaEnum::MASCULINO);
		$sModa = "Moda Masculina";

		require_once "Shop/roupas.php";
	}

	/**
	 * Renderiza a tela das roupas femininas
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function feminino(array $aDados): void {
		$loRoupas = Sistema::getRoupaDAO()->getRoupasByTipo(TipoRoupaEnum::FEMININO);
		$sModa = "Moda Feminina";

		require_once "Shop/roupas.php";
	}

	/**
	 * Renderiza a tela das roupas infantis
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function infantil(array $aDados): void {
		$loRoupas = Sistema::getRoupaDAO()->getRoupasByTipo(TipoRoupaEnum::INFANTIL);
		$sModa = "Moda Infantil";

		require_once "Shop/roupas.php";
	}

	/**
	 * Renderiza a tela das roupas plus size
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function plus(array $aDados): void {
		$loRoupas = Sistema::getRoupaDAO()->getRoupasByTipo(TipoRoupaEnum::PLUS_SIZE);
		$sModa = "Moda Plus-size";

		require_once "Shop/roupas.php";
	}

	/**
	 * Renderiza a tela de visualizar roupa
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function visualizar(array $aDados): void {
		try {
			if (empty($aDados['valor'])) {
				throw new \Exception("Selecione uma roupa para visualizar.",401);
			}

			$iRpaId = $aDados['valor'];
			$oRoupa = Sistema::getRoupaDAO()->find($iRpaId);

			require_once "Shop/visualizar.php";
		} catch (\Exception $oExp) {
			throw new \Exception($oExp->getMessage(),$oExp->getCode());
		}
	}

	/**
	 * Adiciona a roupa ao carrinho
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function adicionarRoupaCarrinho(array $aDados): void {
		$aRetorno = [];

		try {
			if (!Session::hasClienteLogado()) {
				throw new \Exception("É necessário está logado para realizar esta ação.");
			}

			if (!empty($aDados['iRpaId'])) {
				$oRoupa = Sistema::getRoupaDAO()->find($aDados['iRpaId']);
				$oRoupa->adicionarAoCarrinho();

				$aRetorno['status'] = true;
				$aRetorno['msg'] = "Roupa adicionada ao carrinho!";
			} else {
				throw new \Exception("Selecione uma roupa para adicionar ao carrinho.");
			}
		} catch (\Exception $oExp) {
			$aRetorno['status'] = false;
			$aRetorno['msg'] = $oExp->getMessage();
		}

		echo json_encode($aRetorno);
	}

	/**
	 * Remove a roupa do carrinho
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function removerRoupaCarrinho(array $aDados): void {
		$aRetorno = [];

		try {
			if (!Session::hasClienteLogado()) {
				throw new \Exception("É necessário está logado para realizar esta ação.");
			}

			if (!empty($aDados['iRpaId'])) {
				$oRoupa = Sistema::getRoupaDAO()->find($aDados['iRpaId']);
				$oRoupa->removerDoCarrinho();

				$aRetorno['status'] = true;
				$aRetorno['msg'] = "Roupa removida do carrinho!";
			} else {
				throw new \Exception("Selecione uma roupa para remover do carrinho.");
			}
		} catch (\Exception $oExp) {
			$aRetorno['status'] = false;
			$aRetorno['msg'] = $oExp->getMessage();
		}

		echo json_encode($aRetorno);
	}

	/**
	 * Carrega a tela de pagamento
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function pagamento(array $aDados): void {
		try {
			if (!Session::hasClienteLogado()) {
				header("location: ../../login");
			}

			if (!$aDados['tela_pagamento']) {
				header("location: ../../home");
			}

			$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
			$loRoupas = $oCliente->getCarrinho()->getRoupas();

			require_once "Shop/pagamento.php";
		} catch (\Exception $oExp) {
			Session::setMensagem($oExp->getMessage());
			header("location: ../../cliente/espaco");
		}
	}
}