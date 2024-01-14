create table cle_cliente
(
    cle_id              SMALLINT unsigned PRIMARY KEY auto_increment,
    cle_nome            VARCHAR(100) NOT NULL,
    cle_cpf             VARCHAR(11)  NOT NULL,
    cle_data_nascimento DATE         NOT NULL,
    cle_sexo            tinyint(1)   NOT NULL,
    cle_email           VARCHAR(50)  NOT NULL,
    cle_telefone        VARCHAR(11)  NOT NUll,
    cle_senha           VARCHAR(100) NOT NULL,
    cle_cep             VARCHAR(11)  NOT NULL,
    cle_logradouro      VARCHAR(100) NOT NULL,
    cle_bairro          VARCHAR(50)  NOT NULL,
    cle_estado          VARCHAR(50)  NOT NULL,
    cle_cidade          VARCHAR(50)  NOT NULL,
    cle_complemento     VARCHAR(100) NULL,
    cle_numero          varchar(50)  NOT NULL,
    cle_data_cadastro   DATE         NOT NULL
) ENGINE = MyISAM  DEFAULT CHARSET = UTF8MB4;

create table rpa_roupa
(
    rpa_id             SMALLINT unsigned PRIMARY KEY auto_increment,
    rpa_nome           TEXT           NOT NULL,
    rpa_preco          DECIMAL(10, 2) NOT NULL,
    rpa_tipo           TINYINT(1)     NOT NULL,
    rpa_caminho_imagem varchar(50)    not null
) ENGINE=MyISAM DEFAULT CHARSET=UTF8MB4;

create table pdo_pedido
(
    pdo_id          SMALLINT unsigned PRIMARY KEY auto_increment,
    pdo_valor       DECIMAL(10, 2)    NOT NULL,
    pdo_data_pedido date              NOT NULL,
    cle_id          SMALLINT unsigned NOT NULL
) ENGINE = MyISAM
  DEFAULT CHARSET = UTF8MB4;

ALTER TABLE pdo_pedido ADD CONSTRAINT fk_pdo_cle1 FOREIGN KEY (cle_id) REFERENCES cle_cliente (cle_id);

create table rpo_roupa_pedido
(
    rpo_id SMALLINT unsigned PRIMARY KEY auto_increment,
    rpa_id SMALLINT unsigned NOT NULL,
    pdo_id SMALLINT unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=UTF8MB4;

ALTER TABLE rpo_roupa_pedido ADD CONSTRAINT fk_rpo_rpa1 FOREIGN KEY (rpa_id) REFERENCES rpa_roupa (rpa_id);
ALTER TABLE rpo_roupa_pedido ADD CONSTRAINT fk_rpo_pdo1 FOREIGN KEY (pdo_id) REFERENCES pdo_pedido (pdo_id);

create table cro_carrinho
(
    cro_id SMALLINT unsigned PRIMARY KEY auto_increment,
    cle_id SMALLINT unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=UTF8MB4;

ALTER TABLE cro_carrinho ADD CONSTRAINT fk_cro_cle1 FOREIGN KEY (cle_id) REFERENCES cle_cliente (cle_id);

create table cra_carrinho_roupa
(
    cra_id SMALLINT unsigned PRIMARY KEY auto_increment,
    cro_id SMALLINT unsigned NOT NULL,
    rpa_id SMALLINT unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=UTF8MB4;

ALTER TABLE cra_carrinho_roupa ADD CONSTRAINT fk_cra_cro1 FOREIGN KEY (cro_id) REFERENCES cro_carrinho (cro_id);
ALTER TABLE cra_carrinho_roupa ADD CONSTRAINT fk_cra_rpa1 FOREIGN KEY (rpa_id) REFERENCES rpa_roupa (rpa_id);

create table lss_lista_desejos
(
    lss_id SMALLINT unsigned PRIMARY KEY auto_increment,
    cle_id SMALLINT unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=UTF8MB4;

ALTER TABLE lss_lista_desejos ADD CONSTRAINT fk_lss_cle1 FOREIGN KEY (cle_id) REFERENCES cle_cliente (cle_id);

create table lsa_lista_desejos_cliente
(
    lsa_id SMALLINT unsigned PRIMARY KEY auto_increment,
    lss_id SMALLINT unsigned NOT NULL,
    rpa_id SMALLINT unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=UTF8MB4;

ALTER TABLE lsa_lista_desejos_cliente ADD CONSTRAINT fk_lsa_lss1 FOREIGN KEY (lss_id) REFERENCES lss_lista_desejos (lss_id);
ALTER TABLE lsa_lista_desejos_cliente ADD CONSTRAINT fk_lsa_rpa1 FOREIGN KEY (rpa_id) REFERENCES rpa_roupa (rpa_id);