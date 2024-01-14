<?php

namespace DevFashion\Src\Sistema\Enum;

use Exception;

enum SexoEnum implements EnumInterface {

	const MASCULINO = 1;
	const FEMININO = 2;
	const OUTRO = 3;

	/**
	 * Retorna os valores dos tipos de roupa
	 *
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return array
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function getValores(): array {
		$aValores = [];

		$aValores[] = [
			'valor' => self::MASCULINO,
			'descricao' => "Masculino"
		];

		$aValores[] = [
			'valor' => self::FEMININO,
			'descricao' => "Feminino"
		];

		$aValores[] = [
			'valor' => self::OUTRO,
			'descricao' => "Outro"
		];

		return $aValores;
	}

	/**
	 * Retorna a descrição do tipo de roupa
	 *
	 * @param int $iValorEnum
	 * @author Francisco Santos franciscojuniordh@gmail.com
	 * @return string
	 * @throws Exception
	 *
	 * @since 1.0.0 - Definição do versionamento da classe
	 */
	public static function getDescricaoById(int $iValorEnum): string {
		return match ($iValorEnum) {
			self::MASCULINO => "Masculino",
			self::FEMININO => "Feminino",
			self::OUTRO => "Outro",
			default => throw new Exception("Tipo de roupa não encontrada.")
		};
	}
}
