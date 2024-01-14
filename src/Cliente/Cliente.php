<?php

namespace DevFashion\Src\Cliente;

use DevFashion\Src\Carrinho\Carrinho;
use DevFashion\Src\ListaDesejos\ListaDesejos;
use DevFashion\Src\Pedido\Pedido;
use DevFashion\Src\Pedido\PedidoList;
use DevFashion\Src\Roupa\RoupaList;
use DevFashion\Src\Sistema\Enum\SexoEnum;
use DevFashion\Src\Sistema\Sistema;

/**
 * Class Cliente
 * @package DevFashion\Src\Cliente
 * @version 1.0.0
 */
class Cliente {

	private int $iId;
	private string $sNome;
	private string $sCPF;
	private \DateTimeImmutable $oDataNascimento;
	private int $iSexo;
	private string $sEmail;
	private string $sTelefone;
	private string $sCEP;
	private string $sLogradouro;
	private string $sBairro;
	private string $sEstado;
	private string $sCidade;
	private string $sComplemento;
	private string $sNumero;
	private \DateTimeImmutable $oDataCadastro;
	private string $sSenha;
	private ListaDesejos $oListaDesejos;
	private Carrinho $oCarrinho;

	/**
	 * Cria um objeto Cliente a partir de um array
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Cliente
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function createFromArray(array $aDados): Cliente {
		$oCliente = new Cliente();
		$oCliente->iId = $aDados['cle_id'];
		$oCliente->oDataCadastro = new \DateTimeImmutable($aDados['cle_data_cadastro']);
		$oCliente->sSenha = $aDados['cle_senha'];
		$oCliente->setDados($aDados);

		return $oCliente;
	}

	/**
	 * Retorna o Id
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
	 * Retorna se o cliente possui o id preenchido
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function hasId(): bool {
		return !empty($this->iId);
	}

	/**
	 * Atribui o Id
	 *
	 * @param int $iId
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setId(int $iId): void {
		$this->iId = $iId;
	}

	/**
	 * Retorna o nome
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
	 * Retorna o CPF
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getCPF(): string {
		return $this->sCPF;
	}

	/**
	 * Atribui o CPF
	 *
	 * @param string $sCPF
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setCPF(string $sCPF): void {
		$this->sCPF = $sCPF;
	}

	/**
	 * Retorna a data de nascimento
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return \DateTimeImmutable
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getDataNascimento(): \DateTimeImmutable {
		return $this->oDataNascimento;
	}

	/**
	 * Atribui a data de nascimento
	 *
	 * @param \DateTimeImmutable $oDataNascimento
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setDataNascimento(\DateTimeImmutable $oDataNascimento): void {
		$this->oDataNascimento = $oDataNascimento;
	}

	/**
	 * Retorna o e-mail
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getEmail(): string {
		return $this->sEmail;
	}

	/**
	 * Atribui o e-mail
	 *
	 * @param string $sEmail
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setEmail(string $sEmail): void {
		$this->sEmail = $sEmail;
	}

	/**
	 * Retorna o telefone
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getTelefone(): string {
		return $this->sTelefone;
	}

	/**
	 * Atribui o telefone
	 *
	 * @param string $sTelefone
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setTelefone(string $sTelefone): void {
		$this->sTelefone = $sTelefone;
	}

	/**
	 * Retorna o CEP
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getCepEndereco(): string {
		return $this->sCEP;
	}

	/**
	 * Atribui o CEP
	 *
	 * @param string $sCEP
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setCepEndereco(string $sCEP): void {
		$this->sCEP = $sCEP;
	}

	/**
	 * Retorna o logradouro
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getLogradouro(): string {
		return $this->sLogradouro;
	}

	/**
	 * Atribui o logradouro
	 *
	 * @param string $sLogradouro
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setLogradouro(string $sLogradouro): void {
		$this->sLogradouro = $sLogradouro;
	}

	/**
	 * Retorna o bairro
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getBairro(): string {
		return $this->sBairro;
	}

	/**
	 * Atribui o bairro
	 *
	 * @param string $sBairro
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setBairro(string $sBairro): void {
		$this->sBairro = $sBairro;
	}

	/**
	 * Retorna o estado
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getEstado(): string {
		return $this->sEstado;
	}

	/**
	 * Atribui o estado
	 *
	 * @param string $sEstado
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setEstado(string $sEstado): void {
		$this->sEstado = $sEstado;
	}

	/**
	 * Retorna a cidade
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getCidade(): string {
		return $this->sCidade;
	}

	/**
	 * Atribui a cidade
	 *
	 * @param string $sCidade
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setCidade(string $sCidade): void {
		$this->sCidade = $sCidade;
	}

	/**
	 * Retorna o complemento
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getComplemento(): string {
		return $this->sComplemento;
	}

	/**
	 * Retorna se possui complemento
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function hasComplemento(): bool {
		return !empty($this->sComplemento);
	}

	/**
	 * Atribui o complemento
	 *
	 * @param string $sComplemento
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setComplemento(string $sComplemento): void {
		$this->sComplemento = $sComplemento;
	}

	/**
	 * Retorna a data de cadastro
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return \DateTimeImmutable
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getDataCadastro(): \DateTimeImmutable {
		return $this->oDataCadastro;
	}

	/**
	 * Atribui a data de cadastro
	 *
	 * @param \DateTimeImmutable $oDataCadastro
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setDataCadastro(\DateTimeImmutable $oDataCadastro): void {
		$this->oDataCadastro = $oDataCadastro;
	}

	/**
	 * Retorna a senha
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getSenha(): string {
		return $this->sSenha;
	}

	/**
	 * Atribui a senha
	 *
	 * @param string $sSenha
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setSenha(string $sSenha): void {
		$sSenha = password_hash($sSenha,PASSWORD_BCRYPT, ['cost' => 11]);
		$this->sSenha = $sSenha;
	}

	/**
	 * Retorna a descrição do sexo
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getDescricaoSexo(): string {
		return SexoEnum::getDescricaoById($this->iSexo);
	}

	/**
	 * Retorna o Id do sexo no enum de sexo
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return int
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getSexoIdEnum(): int {
		return $this->iSexo;
	}

	/**
	 * Atribui o Sexo
	 *
	 * @param int $iSexo
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setSexo(int $iSexo): void {
		$this->iSexo = $iSexo;
	}

	/**
	 * Retorna o número do endereço
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getNumeroEndereco(): string {
		return $this->sNumero;
	}

	/**
	 * Atribui o número do endereço
	 *
	 * @param string $sNumero
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function setNumeroEndereco(string $sNumero): void {
		$this->sNumero = $sNumero;
	}

	/**
	 * Cadastra o cliente
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function cadastrar(array $aDados): void {
		if ($this->hasCPFCadastrado($aDados)) {
			$sMensagem = "O CPF informado já possui cadastro. Faça o <a href='../../login'>login aqui</a>.";
			throw new \Exception($sMensagem);
		}

		$this->setDados($aDados);
		$this->setSenha($aDados['cle_senha']);
		$this->oDataCadastro = new \DateTimeImmutable("now");

		Sistema::getClienteDAO()->save($this);
	}

	/**
	 * Atualiza as informações do cliente
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function atualizar(array $aDados): void {
		$sCPF = str_replace(".","",str_replace("-","",$aDados['cle_cpf']));

		if ($this->hasCPFCadastrado($aDados) && $sCPF != $this->sCPF) {
			$sMensagem = "O CPF informado já possui cadastro.";
			throw new \Exception($sMensagem);
		}

		$this->setDados($aDados);
		Sistema::getClienteDAO()->update($this);
	}

	/**
	 * Retorna o carrinho
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Carrinho
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getCarrinho(): Carrinho	{
		if (empty($this->oCarrinho)) {
			if (Sistema::getCarrinhoDAO()->hasCarrinho($this)) {
				$this->oCarrinho = Sistema::getCarrinhoDAO()->findByCliente($this);
			} else {
				$oCarrinho = new Carrinho();
				$oCarrinho->cadastrar($this);
				$this->oCarrinho = $oCarrinho;
			}
		}

		return $this->oCarrinho;
	}

	/**
	 * Retorna a lista de desejos do cliente
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return ListaDesejos
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getListaDesejos(): ListaDesejos {
		if (empty($this->oListaDesejos)) {
			if (Sistema::getListaDesejosDAO()->hasListaDesejos($this)) {
				$this->oListaDesejos = Sistema::getListaDesejosDAO()->findByCliente($this);
			} else {
				$oListaDesejos = new ListaDesejos();
				$oListaDesejos->cadastrar($this);
				$this->oListaDesejos = $oListaDesejos;
			}
		}

		return $this->oListaDesejos;
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
	public function getRoupasNaListaDesejos(): RoupaList {
		$oListaDesejos = $this->getListaDesejos();

		return $oListaDesejos->getRoupas();
	}

	/**
	 * Retorna os pedidos do cliente
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return PedidoList
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getPedidos(): PedidoList {
		return Sistema::getPedidoDAO()->findByCliente($this);
	}

	/**
	 * Verifica se o CPF informado no cadastro já está cadastrado
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	private function hasCPFCadastrado(array $aDados): bool {
		$sCPF = str_replace(".","",str_replace("-","",$aDados['cle_cpf']));

		return Sistema::getClienteDAO()->hasCPFCadastrado($sCPF);
	}

	/**
	 * Atribui os dados do array ao cliente
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	private function setDados(array $aDados): void {
		$this->sNome = $aDados['cle_nome'];
		$this->sCPF = str_replace(".","",str_replace("-","",$aDados['cle_cpf']));
		$this->oDataNascimento = new \DateTimeImmutable($aDados['cle_data_nascimento']);
		$this->iSexo = $aDados['cle_sexo'];
		$this->sEmail = $aDados['cle_email'];
		$this->sTelefone = $aDados['cle_telefone'];
		$this->sCEP = $aDados['cle_cep'];
		$this->sLogradouro = $aDados['cle_logradouro'];
		$this->sBairro = $aDados['cle_bairro'];
		$this->sEstado = $aDados['cle_estado'];
		$this->sCidade = $aDados['cle_cidade'];
		$this->sNumero = $aDados['cle_numero'];
		$this->sComplemento = $aDados['cle_complemento'] ?? "";
	}

	/**
	 * Retorna a quantidade de roupas no carrinho
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return int
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function getQuantidadeRoupasNoCarrinho(): int {
		$oCarrinho = $this->getCarrinho();
		$loRoupas = $oCarrinho->getRoupas();

		return $loRoupas->count() ?? 0;
	}

	/**
	 * Cadastra um pedido do cliente
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function cadastrarPedido(array $aDados): void {
		$oPedido = new Pedido();
		$oPedido->setCliente($this);
		$oPedido->setRoupas($this->consultarRoupasPedido($aDados));
		$oPedido->setValorPedido($aDados['pdo_valor']);
		$oPedido->cadastrar();

		$this->getCarrinho()->limpar();
	}

	/**
	 * Consulta as roupas do pedido
	 *
	 * @param array $aDados
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return RoupaList
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	private function consultarRoupasPedido(array $aDados): RoupaList {
		$aRpaId = explode(",",$aDados['sRpaId']);
		$loRoupas = new RoupaList();

		foreach ($aRpaId as $iRpaId) {
			$oRoupa = Sistema::getRoupaDAO()->find($iRpaId);
			$loRoupas->attach($oRoupa);
		}

		return $loRoupas;
	}
}