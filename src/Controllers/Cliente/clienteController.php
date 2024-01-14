<?php

namespace DevFashion\Src\Controllers\Cliente;

use DevFashion\Core\Session;
use DevFashion\Src\Cliente\Cliente;
use DevFashion\Src\Controllers\Sistema\errorController;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class clienteController
 * @package DevFashion\Src\Controllers\Cliente
 * @version 1.0.0
 */
class clienteController {

	/**
	 * Renderiza a lista de desejos
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function lista(array $aDados): void {
		try {
			if (!Session::hasClienteLogado()) {
				header("location: ../../login");
			}

			$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
			$loRoupas = $oCliente->getRoupasNaListaDesejos();

			require_once "Cliente/lista.php";
		} catch (\Exception $oExp) {
			$oErroController = new errorController();
			$oErroController->errorExeption($aDados, $oExp->getMessage(), $oExp->getCode());
			exit();
		}
	}

	/**
	 * Renderiza o espaço do cliente
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function espaco(array $aDados): void {
		try {
			if (!Session::hasClienteLogado()) {
				header("location: ../../login");
			}

			$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
			$loPedidos = $oCliente->getPedidos();

			require_once "Cliente/espaco.php";
		} catch (\Exception $oExp) {
			$oErroController = new errorController();
			$oErroController->errorExeption($aDados, $oExp->getMessage(), $oExp->getCode());
			exit();
		}
	}

	/**
	 * Renderiza o carrinho
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function carrinho(array $aDados): void {
		try {
			if (!Session::hasClienteLogado()) {
				header("location: ../../login");
			}

			$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
			$loRoupas = $oCliente->getCarrinho()->getRoupas();

			require_once "Cliente/carrinho.php";
		} catch (\Exception $oExp) {
			$oErroController = new errorController();
			$oErroController->errorExeption($aDados, $oExp->getMessage(), $oExp->getCode());
			exit();
		}
	}

	/**
	 * Adiciona uma roupa na lista de desejos
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function adicionarRoupaNaListaDesejo(array $aDados): void {
		$aRetorno = [];

		try {
			if (!Session::hasClienteLogado()) {
				throw new \Exception("É necessário está logado para realizar esta ação.");
			}

			if (!empty($aDados['iRpaId'])) {
				$oRoupa = Sistema::getRoupaDAO()->find($aDados['iRpaId']);
				$oRoupa->adicionarNaListaDesejos();

				$aRetorno['status'] = true;
				$aRetorno['msg'] = "Roupa adicionada à lista de desejos!";
			} else {
				throw new \Exception("Selecione uma roupa para adicionar à lista de desejos.");
			}
		} catch (\Exception $oExp) {
			$aRetorno['status'] = false;
			$aRetorno['msg'] = $oExp->getMessage();
		}

		echo json_encode($aRetorno);
	}

	/**
	 * Remove a roupa da lista de desejos
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function removerRoupaDaListaDesejo(array $aDados): void {
		$aRetorno = [];

		try {
			if (!Session::hasClienteLogado()) {
				throw new \Exception("É necessário está logado para realizar esta ação.");
			}

			if (!empty($aDados['iRpaId'])) {
				$oRoupa = Sistema::getRoupaDAO()->find($aDados['iRpaId']);
				$oRoupa->removerRoupaDaListaDesejos();

				$aRetorno['status'] = true;
				$aRetorno['msg'] = "Roupa removida da lista de desejos!";
			} else {
				throw new \Exception("Selecione uma roupa para remover da lista de desejos.");
			}
		} catch (\Exception $oExp) {
			$aRetorno['status'] = false;
			$aRetorno['msg'] = $oExp->getMessage();
		}

		echo json_encode($aRetorno);
	}

	/**
	 * Cadastra um cliente
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function cadastrar(array $aDados): void {
		try {
			$oCliente = new Cliente();
			$oCliente->cadastrar($aDados);
			Session::setClienteId($oCliente->getId());

			Session::setMensagem("Cliente cadastrado com sucesso!");
			header("location: ../../cliente/espaco");
		} catch (\Exception $oExp) {
			Session::setMensagem($oExp->getMessage());
			header("location: ../../login/cadastro");
		}
	}

	/**
	 * Atualiza as informações do cliente
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function atualizar(array $aDados): void {
		try {
			if (!Session::hasClienteLogado()) {
				throw new \Exception("É necessário está logado para realizar esta ação.");
			}

			$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
			$oCliente->atualizar($aDados);

			Session::setMensagem("Cliente atualizado com sucesso!");
			header("location: ../../cliente/espaco");
		} catch (\Exception $oExp) {
			Session::setMensagem($oExp->getMessage());
			header("location: ../../cliente/espaco");
		}
	}

	/**
	 * Atualiza a quantidade de roupas no carrinho
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function atualizarQuantidadeRoupasCarrinho(array $aDados): void {
		$aRetorno = [];

		try {
			if (!Session::hasClienteLogado()) {
				throw new \Exception("É necessário está logado para realizar esta ação.");
			}

			$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());

			$aRetorno['status'] = true;
			$aRetorno['quantidade_roupas'] = $oCliente->getQuantidadeRoupasNoCarrinho();
		} catch (\Exception $oExp) {
			$aRetorno['status'] = false;
			$aRetorno['msg'] = $oExp->getMessage();
		}

		echo json_encode($aRetorno);
	}

	/**
	 * Cadastra o pedido
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function cadastrarPedido(array $aDados): void {
		try {
			if (!Session::hasClienteLogado()) {
				throw new \Exception("É necessário está logado para realizar esta ação.");
			}

			$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
			$oCliente->cadastrarPedido($aDados);

			Session::setMensagem("Pedido efetuado com sucesso!");
			header("location: ../../cliente/espaco");
		} catch (\Exception $oExp) {
			Session::setMensagem($oExp->getMessage());
			header("location: ../../cliente/espaco");
		}
	}
}