<?php

namespace DevFashion\Src\Roupa;

use DevFashion\Core\Session;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class Roupa
 * @package DevFashion\Src\Roupa
 * @version 1.0.0
 */
class Roupa {

	private int $iId;
	private string $sNome;
	private float $fPreco;
	private int $iTipo;
	private string $sCaminhoImagem;

	/**
	 * Cria um objeto Roupa a partir de um array
	 *
	 * @param array $aRoupa
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Roupa
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function createFromArray(array $aRoupa): Roupa {
		$oRoupa = new Roupa();
		$oRoupa->iId = $aRoupa['rpa_id'];
		$oRoupa->sNome = $aRoupa['rpa_nome'];
		$oRoupa->fPreco = doubleval($aRoupa['rpa_preco']);
		$oRoupa->iTipo = $aRoupa['rpa_tipo'];
		$oRoupa->sCaminhoImagem = $aRoupa['rpa_caminho_imagem'];

		return $oRoupa;
	}

	/**
	 * Retorna o Id da roupa
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getId(): int {
		return $this->iId;
	}

	/**
	 * Retorna o nome da roupa
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getNome(): string {
		return $this->sNome;
	}

	/**
	 * Atribui o nome
	 *
	 * @param string $sNome
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setNome(string $sNome): void {
		$this->sNome = $sNome;
	}

	/**
	 * Retorna o preço
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return float
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getPreco(): float {
		return $this->fPreco;
	}

	/**
	 * Retorna a descrição do preço
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getDescricaoPreco(): string {
		return "R$ " . number_format($this->fPreco,2,",",".");
	}

	/**
	 * Atribui o preço
	 *
	 * @param float $fPreco
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setPreco(float $fPreco): void {
		$this->fPreco = $fPreco;
	}

	/**
	 * Retorna o caminho da roupa
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getTipo(): int {
		return $this->iTipo;
	}

	/**
	 * Atribui o tipo da roupa
	 *
	 * @param int $iTipo
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setTipo(int $iTipo): void {
		$this->iTipo = $iTipo;
	}

	/**
	 * Retorna o caminho da imagem
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getCaminhoImagem(): string {
		return $this->sCaminhoImagem;
	}

	/**
	 * Atribui o caminho da imagem
	 *
	 * @param string $sCaminhoImagem
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setCaminhoImagem(string $sCaminhoImagem): void {
		$this->sCaminhoImagem = $sCaminhoImagem;
	}

	/**
	 * Retorna se possui roupa a roupa na lista de desejo
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function estaNaListaDesejos(): bool {
		return Sistema::getListaDesejosDAO()->hasRoupaNaLista($this);
	}

	/**
	 * Adiciona a roupa à lista de desejos
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function adicionarNaListaDesejos(): void {
		if (!Session::hasClienteLogado()) {
			throw new \Exception("É necessário está logado para realizar esta ação.");
		}

		$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
		$oListaDesejos = $oCliente->getListaDesejos();
		$oListaDesejos->adicionarRoupa($this);
	}

	/**
	 * Remove uma roupa da lista de desejos
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function removerRoupaDaListaDesejos(): void {
		if (!Session::hasClienteLogado()) {
			throw new \Exception("É necessário está logado para realizar esta ação.");
		}

		$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
		if (!Sistema::getListaDesejosDAO()->hasListaDesejos($oCliente)) {
			throw new \Exception("O cliente não possui lista de desejos.");
		}

		$oListaDesejos = $oCliente->getListaDesejos();
		$oListaDesejos->removerRoupa($this);
	}

	/**
	 * Adiciona a roupa ao carrinho
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function adicionarAoCarrinho(): void {
		if (!Session::hasClienteLogado()) {
			throw new \Exception("É necessário está logado para realizar esta ação.");
		}

		$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
		$oCarrinho = $oCliente->getCarrinho();

		if ($oCarrinho->hasRoupa($this)) {
			throw new \Exception("Essa roupa já está no seu carrinho.");
		}

		$oCarrinho->adicionarRoupa($this);
	}

	/**
	 * Retorna a descrição do parcelamento padrão
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getDescricaoParcelamento(): string {
		$fPreco = $this->fPreco / 3;
		$fPreco = "R$ " . number_format($fPreco,2,",",".");

		return "Em até <b>3x</b> de $fPreco";
	}

	/**
	 * Remove a roupa do carrinho
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function removerDoCarrinho(): void {
		if (!Session::hasClienteLogado()) {
			throw new \Exception("É necessário está logado para realizar esta ação.");
		}

		$oCliente = Sistema::getClienteDAO()->find(Session::getClienteId());
		$oCarrinho = $oCliente->getCarrinho();

		if (!$oCarrinho->hasRoupa($this)) {
			throw new \Exception("Essa roupa não está no seu carrinho.");
		}

		$oCarrinho->removerRoupa($this);
	}
}