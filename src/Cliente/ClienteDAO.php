<?php

namespace DevFashion\Src\Cliente;

use DevFashion\Src\Sistema\Sistema;

/**
 * Class ClienteDAO
 * @package DevFashion\Src\Cliente
 * @version 1.0.0
 */
class ClienteDAO {

	/**
	 * Consulta o cliente com base no id
	 *
	 * @param int $iCleId
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Cliente
	 * @throws \PDOException|\Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function find(int $iCleId): Cliente {
		$sSql = "SELECT * FROM cle_cliente WHERE cle_id = ?";
		$aParam[] = $iCleId;

		try {
			$aCliente = Sistema::connection()->getRow($sSql,$aParam);
		} catch (\PDOException) {
			throw new \PDOException("Não foi possível consultar o cliente.");
		}

		if (empty($aCliente)) {
			throw new \LogicException("Nenhum cliente encontrado.");
		}

		return Cliente::createFromArray($aCliente);
	}

	/**
	 * Verifica se o CPF informado já possui cadastro
	 *
	 * @param string $sCPF
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return bool
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function hasCPFCadastrado(string $sCPF): bool {
		$sSQL = "SELECT * FROM cle_cliente where cle_cpf = ?";
		$aParam[] = $sCPF;

		try {
			$aCPF = Sistema::connection()->getArray($sSQL,$aParam);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível validar o CPF do cadastro.");
		}

		return !empty($aCPF[0]);
	}
	
	/**
	 * Cadastra um cliente no banco
	 *
	 * @param Cliente $oCliente
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function save(Cliente $oCliente): void {
		$oConnection = Sistema::connection();
		$sSQL = "insert into cle_cliente (
							cle_nome,
							cle_cpf,
							cle_data_nascimento,
							cle_sexo,
							cle_email,
							cle_telefone,
							cle_senha,
							cle_cep,
							cle_logradouro,
							cle_bairro,
							cle_estado,
							cle_cidade,
							cle_complemento,
							cle_numero,
							cle_data_cadastro)
							values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$aParams = [
			$oCliente->getNome(),
			$oCliente->getCPF(),
			$oCliente->getDataNascimento()->format("Y-m-d"),
			$oCliente->getSexoIdEnum(),
			$oCliente->getEmail(),
			$oCliente->getTelefone(),
			$oCliente->getSenha(),
			$oCliente->getCepEndereco(),
			$oCliente->getLogradouro(),
			$oCliente->getBairro(),
			$oCliente->getEstado(),
			$oCliente->getCidade(),
			$oCliente->hasComplemento() ? $oCliente->getComplemento() : "",
			$oCliente->getNumeroEndereco(),
			$oCliente->getDataNascimento()->format("Y-m-d")
		];

		try {
			$oConnection->execute($sSQL,$aParams);
			$oCliente->setId($oConnection->getLasInsertId());
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível cadastrar o cliente");
		}
	}

	/**
	 * Consulta o cliente pelo e-mail
	 *
	 * @param mixed $sEmail
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return Cliente
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function findByEmail(mixed $sEmail): Cliente {
		$sSQL = "select * from cle_cliente where cle_email = ?";
		$aParam[] = $sEmail;

		try {
			$aCliente = Sistema::connection()->getRow($sSQL,$aParam);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível consultar o cliente.");
		}

		if (empty($aCliente)) {
			return new Cliente();
		}

		return Cliente::createFromArray($aCliente);
	}

	/**
	 * Atualiza as informações do cliente
	 *
	 * @param Cliente $oCliente
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return void
	 * @throws \Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public function update(Cliente $oCliente): void {
		$sSQL = "UPDATE cle_cliente set
					cle_nome = ?,
					cle_cpf = ?,
					cle_data_nascimento = ?,
					cle_sexo = ?,
					cle_email = ?,
					cle_telefone = ?,
					cle_senha = ?,
					cle_cep = ?,
					cle_logradouro = ?,
					cle_bairro = ?,
					cle_estado = ?,
					cle_cidade = ?,
					cle_complemento = ?,
					cle_numero = ?,
					cle_data_cadastro = ?
				WHERE
					cle_id = ?";
		$aParams = [
			$oCliente->getNome(),
			$oCliente->getCPF(),
			$oCliente->getDataNascimento()->format("Y-m-d"),
			$oCliente->getSexoIdEnum(),
			$oCliente->getEmail(),
			$oCliente->getTelefone(),
			$oCliente->getSenha(),
			$oCliente->getCepEndereco(),
			$oCliente->getLogradouro(),
			$oCliente->getBairro(),
			$oCliente->getEstado(),
			$oCliente->getCidade(),
			$oCliente->hasComplemento() ? $oCliente->getComplemento() : "",
			$oCliente->getNumeroEndereco(),
			$oCliente->getDataNascimento()->format("Y-m-d"),
			$oCliente->getId()
		];

		try {
			Sistema::connection()->execute($sSQL,$aParams);
		} catch (\PDOException $oExp) {
			throw new \Exception("Não foi possível cadastrar o cliente");
		}
	}
}