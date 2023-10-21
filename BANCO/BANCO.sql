--
-- Estrutura da tabela `caixa`
--

DROP TABLE IF EXISTS caixa;

CREATE TABLE IF NOT EXISTS `caixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioabertura` varchar(255) NOT NULL,
  `dataabertura` date NOT NULL,
  `horaabertura` time NOT NULL DEFAULT '00:00:00',
  `saldoinicial` decimal(10,2) NOT NULL,
  `usuariofechamento` varchar(255) NOT NULL,
  `datafechamento` date NOT NULL,
  `horafechamento` time NOT NULL,
  `entrada` decimal(10,2) NOT NULL,
  `saida` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO caixa (`id`, `usuarioabertura`, `dataabertura`, `horaabertura`, `saldoinicial`, `usuariofechamento`, `datafechamento`, `horafechamento`, `entrada`, `saida`, `total`) VALUES (0, 'InfoLab', '2016-01-01', '00:00:00', '0.00', 'InfoLab', '2016-01-01', '00:00:00', '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_sessions`
--

DROP TABLE IF EXISTS ci_sessions;

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS clientes;

CREATE TABLE IF NOT EXISTS `clientes` (
  `idClientes` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCliente` varchar(255) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `telefone2` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `rua` varchar(70) DEFAULT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `update` char(10) DEFAULT NULL,
  `ativo` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idClientes`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO clientes (`idClientes`, `nomeCliente`, `nascimento`, `telefone`, `dataCadastro`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `update`, `ativo`) VALUES (1, '(Baixa no estoque)', '2016-01-01', '(99) 99999-9999', '2016-09-07', 'Nome da Rua', '999', 'Bairro do estabelecimento', 'Cidade', 'Estado', '99999999', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `emitente`
--

DROP TABLE IF EXISTS emitente;

CREATE TABLE IF NOT EXISTS `emitente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `ie` varchar(50) DEFAULT NULL,
  `rua` varchar(70) DEFAULT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `uf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `url_logo` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS produtos;

CREATE TABLE IF NOT EXISTS `produtos` (
  `idProdutos` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(80) NOT NULL,
  `unidade` varchar(10) DEFAULT NULL,
  `precoCompra` decimal(10,2) DEFAULT NULL,
  `precoVenda` decimal(10,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `estoqueMinimo` int(11) DEFAULT NULL,
  `ativo` int(2) NOT NULL DEFAULT '1',
  `codigo_barras` varchar(14) NOT NULL,
  PRIMARY KEY (`idProdutos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

DROP TABLE IF EXISTS servicos;

CREATE TABLE IF NOT EXISTS `servicos` (
  `idServicos` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idServicos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_caixa`
--

DROP TABLE IF EXISTS status_caixa;

CREATE TABLE IF NOT EXISTS `status_caixa` (
  `id` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO status_caixa (`id`, `status`) VALUES (0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS usuarios;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `rua` varchar(70) DEFAULT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL,
  `dataCadastro` date NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`idUsuarios`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO usuarios (`idUsuarios`, `nome`, `rg`, `cpf`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `email`, `senha`, `telefone`, `celular`, `situacao`, `dataCadastro`, `nivel`) VALUES (1, 'InfoLab', '99.999.999-9', '999.999.999-99', 'Aurelio Agostinho Ruete', '600', 'Jardim Uniao', 'Palmares Paulista', 'SP', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '(17) 99619-9719', NULL, 1, '2016-01-01', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lancamentos`
--

DROP TABLE IF EXISTS lancamentos;

CREATE TABLE IF NOT EXISTS `lancamentos` (
  `idLancamentos` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) DEFAULT NULL,
  `valor` varchar(15) NOT NULL,
  `data_vencimento` date NOT NULL,
  `baixado` tinyint(1) DEFAULT NULL,
  `cliente_fornecedor` varchar(255) DEFAULT NULL,
  `forma_pgto` varchar(100) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `aparece_no_caixa` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idLancamentos`),
  KEY `fk_lancamentos_clientes1` (`clientes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `os`
--

DROP TABLE IF EXISTS os;

CREATE TABLE IF NOT EXISTS `os` (
  `idOs` int(11) NOT NULL AUTO_INCREMENT,
  `dataInicial` date DEFAULT NULL,
  `dataFinal` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `observacoes` varchar(150) DEFAULT NULL,
  `valorTotal` varchar(15) DEFAULT NULL,
  `clientes_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `lancamento` int(11) DEFAULT NULL,
  `faturado` tinyint(1) NOT NULL,
  PRIMARY KEY (`idOs`),
  KEY `fk_os_clientes1` (`clientes_id`),
  KEY `fk_os_usuarios1` (`usuarios_id`),
  KEY `fk_os_lancamentos1` (`lancamento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_os`
--

DROP TABLE IF EXISTS produtos_os;

CREATE TABLE IF NOT EXISTS `produtos_os` (
  `idProdutos_os` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) NOT NULL,
  `os_id` int(11) NOT NULL,
  `produtos_id` int(11) NOT NULL,
  `subTotal` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idProdutos_os`),
  KEY `fk_produtos_os_os1` (`os_id`),
  KEY `fk_produtos_os_produtos1` (`produtos_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS vendas;

CREATE TABLE IF NOT EXISTS `vendas` (
  `idVendas` int(11) NOT NULL AUTO_INCREMENT,
  `dataVenda` date DEFAULT NULL,
  `valorTotal` varchar(45) DEFAULT NULL,
  `desconto` varchar(45) DEFAULT NULL,
  `faturado` tinyint(1) DEFAULT NULL,
  `clientes_id` int(11) NOT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `lancamentos_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idVendas`),
  KEY `fk_vendas_clientes1` (`clientes_id`),
  KEY `fk_vendas_usuarios1` (`usuarios_id`),
  KEY `fk_vendas_lancamentos1` (`lancamentos_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_de_vendas`
--

DROP TABLE IF EXISTS itens_de_vendas;

CREATE TABLE IF NOT EXISTS `itens_de_vendas` (
  `idItens` int(11) NOT NULL AUTO_INCREMENT,
  `subTotal` varchar(45) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `vendas_id` int(11) NOT NULL,
  `produtos_id` int(11) NOT NULL,
  PRIMARY KEY (`idItens`),
  KEY `fk_itens_de_vendas_vendas1` (`vendas_id`),
  KEY `fk_itens_de_vendas_produtos1` (`produtos_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acompanhamento`
--

CREATE TABLE IF NOT EXISTS `acompanhamento` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `clientes_id` int(5) NOT NULL,
  `obj_1` varchar(50) NOT NULL,
  `obj_2` varchar(50) NOT NULL,
  `obj_peso` varchar(3) NOT NULL,
  `obj_prazo` varchar(3) NOT NULL,
  `obj_prazo_data` date NOT NULL,
  `tel_emergencia` varchar(15) NOT NULL,
  `resp_emergencia` varchar(15) NOT NULL,
  `tel_extra_emergencia` varchar(15) NOT NULL,
  `q1` int(1) NOT NULL,
  `q2` int(1) NOT NULL,
  `q3` int(1) NOT NULL,
  `q4` int(1) NOT NULL,
  `q5` int(1) NOT NULL,
  `q6` int(1) NOT NULL,
  `q7` int(1) NOT NULL,
  `a1` int(11) NOT NULL,
  `a2_1` int(1) NOT NULL,
  `a2_2` int(1) NOT NULL,
  `a2_3` int(1) NOT NULL,
  `a2_4` int(1) NOT NULL,
  `a2_5` int(1) NOT NULL,
  `a2_6` int(1) NOT NULL,
  `a2_7` int(1) NOT NULL,
  `a2_8` int(1) NOT NULL,
  `a2_9` int(1) NOT NULL,
  `a2_10` int(1) NOT NULL,
  `a2_11` int(1) NOT NULL,
  `a2_12` int(1) NOT NULL,
  `a3_1` int(1) NOT NULL,
  `a3_2` int(1) NOT NULL,
  `a3_3` varchar(255) NOT NULL,
  `a4` varchar(255) NOT NULL,
  `a5` int(1) NOT NULL,
  `a6` int(1) NOT NULL,
  `a6_1` varchar(3) NOT NULL,
  `a7_1` varchar(255) NOT NULL,
  `a7_2` int(1) NOT NULL,
  `a8_1` varchar(2) NOT NULL,
  `a8_2` int(1) NOT NULL,
  `a9_1` int(1) NOT NULL,
  `a9_2` int(1) NOT NULL,
  `a9_3` int(1) NOT NULL,
  `a9_4` int(1) NOT NULL,
  `seg_exe1` varchar(50) NOT NULL,
  `seg_exe2` varchar(50) NOT NULL,
  `seg_exe3` varchar(50) NOT NULL,
  `seg_exe4` varchar(50) NOT NULL,
  `seg_exe5` varchar(50) NOT NULL,
  `seg_exe6` varchar(50) NOT NULL,
  `seg_exe7` varchar(50) NOT NULL,
  `seg_exe8` varchar(50) NOT NULL,
  `seg_exe9` varchar(50) NOT NULL,
  `seg_exe10` varchar(50) NOT NULL,
  `seg_serie1` varchar(50) NOT NULL,
  `seg_serie2` varchar(50) NOT NULL,
  `seg_serie3` varchar(50) NOT NULL,
  `seg_serie4` varchar(50) NOT NULL,
  `seg_serie5` varchar(50) NOT NULL,
  `seg_serie6` varchar(50) NOT NULL,
  `seg_serie7` varchar(50) NOT NULL,
  `seg_serie8` varchar(50) NOT NULL,
  `seg_serie9` varchar(50) NOT NULL,
  `seg_serie10` varchar(50) NOT NULL,
  `seg_rep1` varchar(50) NOT NULL,
  `seg_rep2` varchar(50) NOT NULL,
  `seg_rep3` varchar(50) NOT NULL,
  `seg_rep4` varchar(50) NOT NULL,
  `seg_rep5` varchar(50) NOT NULL,
  `seg_rep6` varchar(50) NOT NULL,
  `seg_rep7` varchar(50) NOT NULL,
  `seg_rep8` varchar(50) NOT NULL,
  `seg_rep9` varchar(50) NOT NULL,
  `seg_rep10` varchar(50) NOT NULL,
  `seg_obs1` varchar(50) NOT NULL,
  `seg_obs2` varchar(50) NOT NULL,
  `seg_obs3` varchar(50) NOT NULL,
  `seg_obs4` varchar(50) NOT NULL,
  `seg_obs5` varchar(50) NOT NULL,
  `seg_obs6` varchar(50) NOT NULL,
  `seg_obs7` varchar(50) NOT NULL,
  `seg_obs8` varchar(50) NOT NULL,
  `seg_obs9` varchar(50) NOT NULL,
  `seg_obs10` varchar(50) NOT NULL,
  `ter_exe1` varchar(50) NOT NULL,
  `ter_exe2` varchar(50) NOT NULL,
  `ter_exe3` varchar(50) NOT NULL,
  `ter_exe4` varchar(50) NOT NULL,
  `ter_exe5` varchar(50) NOT NULL,
  `ter_exe6` varchar(50) NOT NULL,
  `ter_exe7` varchar(50) NOT NULL,
  `ter_exe8` varchar(50) NOT NULL,
  `ter_exe9` varchar(50) NOT NULL,
  `ter_exe10` varchar(50) NOT NULL,
  `ter_serie1` varchar(50) NOT NULL,
  `ter_serie2` varchar(50) NOT NULL,
  `ter_serie3` varchar(50) NOT NULL,
  `ter_serie4` varchar(50) NOT NULL,
  `ter_serie5` varchar(50) NOT NULL,
  `ter_serie6` varchar(50) NOT NULL,
  `ter_serie7` varchar(50) NOT NULL,
  `ter_serie8` varchar(50) NOT NULL,
  `ter_serie9` varchar(50) NOT NULL,
  `ter_serie10` varchar(50) NOT NULL,
  `ter_rep1` varchar(50) NOT NULL,
  `ter_rep2` varchar(50) NOT NULL,
  `ter_rep3` varchar(50) NOT NULL,
  `ter_rep4` varchar(50) NOT NULL,
  `ter_rep5` varchar(50) NOT NULL,
  `ter_rep6` varchar(50) NOT NULL,
  `ter_rep7` varchar(50) NOT NULL,
  `ter_rep8` varchar(50) NOT NULL,
  `ter_rep9` varchar(50) NOT NULL,
  `ter_rep10` varchar(50) NOT NULL,
  `ter_obs1` varchar(50) NOT NULL,
  `ter_obs2` varchar(50) NOT NULL,
  `ter_obs3` varchar(50) NOT NULL,
  `ter_obs4` varchar(50) NOT NULL,
  `ter_obs5` varchar(50) NOT NULL,
  `ter_obs6` varchar(50) NOT NULL,
  `ter_obs7` varchar(50) NOT NULL,
  `ter_obs8` varchar(50) NOT NULL,
  `ter_obs9` varchar(50) NOT NULL,
  `ter_obs10` varchar(50) NOT NULL,
  `qua_exe1` varchar(50) NOT NULL,
  `qua_exe2` varchar(50) NOT NULL,
  `qua_exe3` varchar(50) NOT NULL,
  `qua_exe4` varchar(50) NOT NULL,
  `qua_exe5` varchar(50) NOT NULL,
  `qua_exe6` varchar(50) NOT NULL,
  `qua_exe7` varchar(50) NOT NULL,
  `qua_exe8` varchar(50) NOT NULL,
  `qua_exe9` varchar(50) NOT NULL,
  `qua_exe10` varchar(50) NOT NULL,
  `qua_serie1` varchar(50) NOT NULL,
  `qua_serie2` varchar(50) NOT NULL,
  `qua_serie3` varchar(50) NOT NULL,
  `qua_serie4` varchar(50) NOT NULL,
  `qua_serie5` varchar(50) NOT NULL,
  `qua_serie6` varchar(50) NOT NULL,
  `qua_serie7` varchar(50) NOT NULL,
  `qua_serie8` varchar(50) NOT NULL,
  `qua_serie9` varchar(50) NOT NULL,
  `qua_serie10` varchar(50) NOT NULL,
  `qua_rep1` varchar(50) NOT NULL,
  `qua_rep2` varchar(50) NOT NULL,
  `qua_rep3` varchar(50) NOT NULL,
  `qua_rep4` varchar(50) NOT NULL,
  `qua_rep5` varchar(50) NOT NULL,
  `qua_rep6` varchar(50) NOT NULL,
  `qua_rep7` varchar(50) NOT NULL,
  `qua_rep8` varchar(50) NOT NULL,
  `qua_rep9` varchar(50) NOT NULL,
  `qua_rep10` varchar(50) NOT NULL,
  `qua_obs1` varchar(50) NOT NULL,
  `qua_obs2` varchar(50) NOT NULL,
  `qua_obs3` varchar(50) NOT NULL,
  `qua_obs4` varchar(50) NOT NULL,
  `qua_obs5` varchar(50) NOT NULL,
  `qua_obs6` varchar(50) NOT NULL,
  `qua_obs7` varchar(50) NOT NULL,
  `qua_obs8` varchar(50) NOT NULL,
  `qua_obs9` varchar(50) NOT NULL,
  `qua_obs10` varchar(50) NOT NULL,
  `qui_exe1` varchar(50) NOT NULL,
  `qui_exe2` varchar(50) NOT NULL,
  `qui_exe3` varchar(50) NOT NULL,
  `qui_exe4` varchar(50) NOT NULL,
  `qui_exe5` varchar(50) NOT NULL,
  `qui_exe6` varchar(50) NOT NULL,
  `qui_exe7` varchar(50) NOT NULL,
  `qui_exe8` varchar(50) NOT NULL,
  `qui_exe9` varchar(50) NOT NULL,
  `qui_exe10` varchar(50) NOT NULL,
  `qui_serie1` varchar(50) NOT NULL,
  `qui_serie2` varchar(50) NOT NULL,
  `qui_serie3` varchar(50) NOT NULL,
  `qui_serie4` varchar(50) NOT NULL,
  `qui_serie5` varchar(50) NOT NULL,
  `qui_serie6` varchar(50) NOT NULL,
  `qui_serie7` varchar(50) NOT NULL,
  `qui_serie8` varchar(50) NOT NULL,
  `qui_serie9` varchar(50) NOT NULL,
  `qui_serie10` varchar(50) NOT NULL,
  `qui_rep1` varchar(50) NOT NULL,
  `qui_rep2` varchar(50) NOT NULL,
  `qui_rep3` varchar(50) NOT NULL,
  `qui_rep4` varchar(50) NOT NULL,
  `qui_rep5` varchar(50) NOT NULL,
  `qui_rep6` varchar(50) NOT NULL,
  `qui_rep7` varchar(50) NOT NULL,
  `qui_rep8` varchar(50) NOT NULL,
  `qui_rep9` varchar(50) NOT NULL,
  `qui_rep10` varchar(50) NOT NULL,
  `qui_obs1` varchar(50) NOT NULL,
  `qui_obs2` varchar(50) NOT NULL,
  `qui_obs3` varchar(50) NOT NULL,
  `qui_obs4` varchar(50) NOT NULL,
  `qui_obs5` varchar(50) NOT NULL,
  `qui_obs6` varchar(50) NOT NULL,
  `qui_obs7` varchar(50) NOT NULL,
  `qui_obs8` varchar(50) NOT NULL,
  `qui_obs9` varchar(50) NOT NULL,
  `qui_obs10` varchar(50) NOT NULL,
  `sex_exe1` varchar(50) NOT NULL,
  `sex_exe2` varchar(50) NOT NULL,
  `sex_exe3` varchar(50) NOT NULL,
  `sex_exe4` varchar(50) NOT NULL,
  `sex_exe5` varchar(50) NOT NULL,
  `sex_exe6` varchar(50) NOT NULL,
  `sex_exe7` varchar(50) NOT NULL,
  `sex_exe8` varchar(50) NOT NULL,
  `sex_exe9` varchar(50) NOT NULL,
  `sex_exe10` varchar(50) NOT NULL,
  `sex_serie1` varchar(50) NOT NULL,
  `sex_serie2` varchar(50) NOT NULL,
  `sex_serie3` varchar(50) NOT NULL,
  `sex_serie4` varchar(50) NOT NULL,
  `sex_serie5` varchar(50) NOT NULL,
  `sex_serie6` varchar(50) NOT NULL,
  `sex_serie7` varchar(50) NOT NULL,
  `sex_serie8` varchar(50) NOT NULL,
  `sex_serie9` varchar(50) NOT NULL,
  `sex_serie10` varchar(50) NOT NULL,
  `sex_rep1` varchar(50) NOT NULL,
  `sex_rep2` varchar(50) NOT NULL,
  `sex_rep3` varchar(50) NOT NULL,
  `sex_rep4` varchar(50) NOT NULL,
  `sex_rep5` varchar(50) NOT NULL,
  `sex_rep6` varchar(50) NOT NULL,
  `sex_rep7` varchar(50) NOT NULL,
  `sex_rep8` varchar(50) NOT NULL,
  `sex_rep9` varchar(50) NOT NULL,
  `sex_rep10` varchar(50) NOT NULL,
  `sex_obs1` varchar(50) NOT NULL,
  `sex_obs2` varchar(50) NOT NULL,
  `sex_obs3` varchar(50) NOT NULL,
  `sex_obs4` varchar(50) NOT NULL,
  `sex_obs5` varchar(50) NOT NULL,
  `sex_obs6` varchar(50) NOT NULL,
  `sex_obs7` varchar(50) NOT NULL,
  `sex_obs8` varchar(50) NOT NULL,
  `sex_obs9` varchar(50) NOT NULL,
  `sex_obs10` varchar(50) NOT NULL,
  `sab_exe1` varchar(50) NOT NULL,
  `sab_exe2` varchar(50) NOT NULL,
  `sab_exe3` varchar(50) NOT NULL,
  `sab_exe4` varchar(50) NOT NULL,
  `sab_exe5` varchar(50) NOT NULL,
  `sab_exe6` varchar(50) NOT NULL,
  `sab_exe7` varchar(50) NOT NULL,
  `sab_exe8` varchar(50) NOT NULL,
  `sab_exe9` varchar(50) NOT NULL,
  `sab_exe10` varchar(50) NOT NULL,
  `sab_serie1` varchar(50) NOT NULL,
  `sab_serie2` varchar(50) NOT NULL,
  `sab_serie3` varchar(50) NOT NULL,
  `sab_serie4` varchar(50) NOT NULL,
  `sab_serie5` varchar(50) NOT NULL,
  `sab_serie6` varchar(50) NOT NULL,
  `sab_serie7` varchar(50) NOT NULL,
  `sab_serie8` varchar(50) NOT NULL,
  `sab_serie9` varchar(50) NOT NULL,
  `sab_serie10` varchar(50) NOT NULL,
  `sab_rep1` varchar(50) NOT NULL,
  `sab_rep2` varchar(50) NOT NULL,
  `sab_rep3` varchar(50) NOT NULL,
  `sab_rep4` varchar(50) NOT NULL,
  `sab_rep5` varchar(50) NOT NULL,
  `sab_rep6` varchar(50) NOT NULL,
  `sab_rep7` varchar(50) NOT NULL,
  `sab_rep8` varchar(50) NOT NULL,
  `sab_rep9` varchar(50) NOT NULL,
  `sab_rep10` varchar(50) NOT NULL,
  `sab_obs1` varchar(50) NOT NULL,
  `sab_obs2` varchar(50) NOT NULL,
  `sab_obs3` varchar(50) NOT NULL,
  `sab_obs4` varchar(50) NOT NULL,
  `sab_obs5` varchar(50) NOT NULL,
  `sab_obs6` varchar(50) NOT NULL,
  `sab_obs7` varchar(50) NOT NULL,
  `sab_obs8` varchar(50) NOT NULL,
  `sab_obs9` varchar(50) NOT NULL,
  `sab_obs10` varchar(50) NOT NULL,
  `last_update` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `anoselecionado`
--

CREATE TABLE IF NOT EXISTS `anoselecionado` (
  `anoselecionado` int(4) NOT NULL DEFAULT '2016',
  `anoselecionado_mes_pagos` int(4) NOT NULL,
  `anoselecionado_rel_men_pagas` int(4) NOT NULL,
  `anoselecionado_rel_men` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `anoselecionado` (`anoselecionado`, `anoselecionado_mes_pagos`, `anoselecionado_rel_men_pagas`, `anoselecionado_rel_men`) VALUES
(2016, 2016, 2016, 2016);
-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `idAvaliacao` int(5) NOT NULL AUTO_INCREMENT,
  `acompanhamento_id` int(5) NOT NULL,
  `clientes_id` int(5) NOT NULL,
  `usuarios_id` int(5) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `altura` decimal(10,2) NOT NULL,
  `imc` decimal(10,2) NOT NULL,
  `status_imc` varchar(20) NOT NULL,
  `pescoco` decimal(10,2) NOT NULL,
  `torax` decimal(10,2) NOT NULL,
  `abdominal` decimal(10,2) NOT NULL,
  `cintura` decimal(10,2) NOT NULL,
  `quadril` decimal(10,2) NOT NULL,
  `braco_rel_esq` decimal(10,2) NOT NULL,
  `braco_rel_dir` decimal(10,2) NOT NULL,
  `braco_con_esq` decimal(10,2) NOT NULL,
  `braco_con_dir` decimal(10,2) NOT NULL,
  `antebraco_esq` decimal(10,2) NOT NULL,
  `antebraco_dir` decimal(10,2) NOT NULL,
  `coxa_esq` decimal(10,2) NOT NULL,
  `coxa_dir` decimal(10,2) NOT NULL,
  `perna_esq` decimal(10,2) NOT NULL,
  `perna_dir` decimal(10,2) NOT NULL,
  `dobra_triceps` int(3) NOT NULL,
  `dobra_abdominal` int(3) NOT NULL,
  `dobra_pant_medial` int(3) NOT NULL,
  `dobra_biceps` int(3) NOT NULL,
  `dobra_supra_iliaca` int(3) NOT NULL,
  `dobra_subescapular` int(3) NOT NULL,
  `dobra_coxa_medial` int(3) NOT NULL,
  `dobra_torax` int(3) NOT NULL,
  `dobra_axilar_media` int(3) NOT NULL,
  `dobra_supra_espinal` int(3) NOT NULL,
  `data_avaliacao` date NOT NULL,
  PRIMARY KEY (`idAvaliacao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------


--
-- Estrutura da tabela `exercicios`
--

CREATE TABLE IF NOT EXISTS `exercicios` (
  `idExercicio` int(5) NOT NULL AUTO_INCREMENT,
  `acompanhamento_id` int(5) NOT NULL,
  `seg_exe1` varchar(50) NOT NULL,
  `seg_exe2` varchar(50) NOT NULL,
  `seg_exe3` varchar(50) NOT NULL,
  `seg_exe4` varchar(50) NOT NULL,
  `seg_exe5` varchar(50) NOT NULL,
  `seg_exe6` varchar(50) NOT NULL,
  `seg_exe7` varchar(50) NOT NULL,
  `seg_exe8` varchar(50) NOT NULL,
  `seg_exe9` varchar(50) NOT NULL,
  `seg_exe10` varchar(50) NOT NULL,
  `seg_serie1` varchar(50) NOT NULL,
  `seg_serie2` varchar(50) NOT NULL,
  `seg_serie3` varchar(50) NOT NULL,
  `seg_serie4` varchar(50) NOT NULL,
  `seg_serie5` varchar(50) NOT NULL,
  `seg_serie6` varchar(50) NOT NULL,
  `seg_serie7` varchar(50) NOT NULL,
  `seg_serie8` varchar(50) NOT NULL,
  `seg_serie9` varchar(50) NOT NULL,
  `seg_serie10` varchar(50) NOT NULL,
  `seg_rep1` varchar(50) NOT NULL,
  `seg_rep2` varchar(50) NOT NULL,
  `seg_rep3` varchar(50) NOT NULL,
  `seg_rep4` varchar(50) NOT NULL,
  `seg_rep5` varchar(50) NOT NULL,
  `seg_rep6` varchar(50) NOT NULL,
  `seg_rep7` varchar(50) NOT NULL,
  `seg_rep8` varchar(50) NOT NULL,
  `seg_rep9` varchar(50) NOT NULL,
  `seg_rep10` varchar(50) NOT NULL,
  `seg_obs1` varchar(50) NOT NULL,
  `seg_obs2` varchar(50) NOT NULL,
  `seg_obs3` varchar(50) NOT NULL,
  `seg_obs4` varchar(50) NOT NULL,
  `seg_obs5` varchar(50) NOT NULL,
  `seg_obs6` varchar(50) NOT NULL,
  `seg_obs7` varchar(50) NOT NULL,
  `seg_obs8` varchar(50) NOT NULL,
  `seg_obs9` varchar(50) NOT NULL,
  `seg_obs10` varchar(50) NOT NULL,
  `ter_exe1` varchar(50) NOT NULL,
  `ter_exe2` varchar(50) NOT NULL,
  `ter_exe3` varchar(50) NOT NULL,
  `ter_exe4` varchar(50) NOT NULL,
  `ter_exe5` varchar(50) NOT NULL,
  `ter_exe6` varchar(50) NOT NULL,
  `ter_exe7` varchar(50) NOT NULL,
  `ter_exe8` varchar(50) NOT NULL,
  `ter_exe9` varchar(50) NOT NULL,
  `ter_exe10` varchar(50) NOT NULL,
  `ter_serie1` varchar(50) NOT NULL,
  `ter_serie2` varchar(50) NOT NULL,
  `ter_serie3` varchar(50) NOT NULL,
  `ter_serie4` varchar(50) NOT NULL,
  `ter_serie5` varchar(50) NOT NULL,
  `ter_serie6` varchar(50) NOT NULL,
  `ter_serie7` varchar(50) NOT NULL,
  `ter_serie8` varchar(50) NOT NULL,
  `ter_serie9` varchar(50) NOT NULL,
  `ter_serie10` varchar(50) NOT NULL,
  `ter_rep1` varchar(50) NOT NULL,
  `ter_rep2` varchar(50) NOT NULL,
  `ter_rep3` varchar(50) NOT NULL,
  `ter_rep4` varchar(50) NOT NULL,
  `ter_rep5` varchar(50) NOT NULL,
  `ter_rep6` varchar(50) NOT NULL,
  `ter_rep7` varchar(50) NOT NULL,
  `ter_rep8` varchar(50) NOT NULL,
  `ter_rep9` varchar(50) NOT NULL,
  `ter_rep10` varchar(50) NOT NULL,
  `ter_obs1` varchar(50) NOT NULL,
  `ter_obs2` varchar(50) NOT NULL,
  `ter_obs3` varchar(50) NOT NULL,
  `ter_obs4` varchar(50) NOT NULL,
  `ter_obs5` varchar(50) NOT NULL,
  `ter_obs6` varchar(50) NOT NULL,
  `ter_obs7` varchar(50) NOT NULL,
  `ter_obs8` varchar(50) NOT NULL,
  `ter_obs9` varchar(50) NOT NULL,
  `ter_obs10` varchar(50) NOT NULL,
  `qua_exe1` varchar(50) NOT NULL,
  `qua_exe2` varchar(50) NOT NULL,
  `qua_exe3` varchar(50) NOT NULL,
  `qua_exe4` varchar(50) NOT NULL,
  `qua_exe5` varchar(50) NOT NULL,
  `qua_exe6` varchar(50) NOT NULL,
  `qua_exe7` varchar(50) NOT NULL,
  `qua_exe8` varchar(50) NOT NULL,
  `qua_exe9` varchar(50) NOT NULL,
  `qua_exe10` varchar(50) NOT NULL,
  `qua_serie1` varchar(50) NOT NULL,
  `qua_serie2` varchar(50) NOT NULL,
  `qua_serie3` varchar(50) NOT NULL,
  `qua_serie4` varchar(50) NOT NULL,
  `qua_serie5` varchar(50) NOT NULL,
  `qua_serie6` varchar(50) NOT NULL,
  `qua_serie7` varchar(50) NOT NULL,
  `qua_serie8` varchar(50) NOT NULL,
  `qua_serie9` varchar(50) NOT NULL,
  `qua_serie10` varchar(50) NOT NULL,
  `qua_rep1` varchar(50) NOT NULL,
  `qua_rep2` varchar(50) NOT NULL,
  `qua_rep3` varchar(50) NOT NULL,
  `qua_rep4` varchar(50) NOT NULL,
  `qua_rep5` varchar(50) NOT NULL,
  `qua_rep6` varchar(50) NOT NULL,
  `qua_rep7` varchar(50) NOT NULL,
  `qua_rep8` varchar(50) NOT NULL,
  `qua_rep9` varchar(50) NOT NULL,
  `qua_rep10` varchar(50) NOT NULL,
  `qua_obs1` varchar(50) NOT NULL,
  `qua_obs2` varchar(50) NOT NULL,
  `qua_obs3` varchar(50) NOT NULL,
  `qua_obs4` varchar(50) NOT NULL,
  `qua_obs5` varchar(50) NOT NULL,
  `qua_obs6` varchar(50) NOT NULL,
  `qua_obs7` varchar(50) NOT NULL,
  `qua_obs8` varchar(50) NOT NULL,
  `qua_obs9` varchar(50) NOT NULL,
  `qua_obs10` varchar(50) NOT NULL,
  `qui_exe1` varchar(50) NOT NULL,
  `qui_exe2` varchar(50) NOT NULL,
  `qui_exe3` varchar(50) NOT NULL,
  `qui_exe4` varchar(50) NOT NULL,
  `qui_exe5` varchar(50) NOT NULL,
  `qui_exe6` varchar(50) NOT NULL,
  `qui_exe7` varchar(50) NOT NULL,
  `qui_exe8` varchar(50) NOT NULL,
  `qui_exe9` varchar(50) NOT NULL,
  `qui_exe10` varchar(50) NOT NULL,
  `qui_serie1` varchar(50) NOT NULL,
  `qui_serie2` varchar(50) NOT NULL,
  `qui_serie3` varchar(50) NOT NULL,
  `qui_serie4` varchar(50) NOT NULL,
  `qui_serie5` varchar(50) NOT NULL,
  `qui_serie6` varchar(50) NOT NULL,
  `qui_serie7` varchar(50) NOT NULL,
  `qui_serie8` varchar(50) NOT NULL,
  `qui_serie9` varchar(50) NOT NULL,
  `qui_serie10` varchar(50) NOT NULL,
  `qui_rep1` varchar(50) NOT NULL,
  `qui_rep2` varchar(50) NOT NULL,
  `qui_rep3` varchar(50) NOT NULL,
  `qui_rep4` varchar(50) NOT NULL,
  `qui_rep5` varchar(50) NOT NULL,
  `qui_rep6` varchar(50) NOT NULL,
  `qui_rep7` varchar(50) NOT NULL,
  `qui_rep8` varchar(50) NOT NULL,
  `qui_rep9` varchar(50) NOT NULL,
  `qui_rep10` varchar(50) NOT NULL,
  `qui_obs1` varchar(50) NOT NULL,
  `qui_obs2` varchar(50) NOT NULL,
  `qui_obs3` varchar(50) NOT NULL,
  `qui_obs4` varchar(50) NOT NULL,
  `qui_obs5` varchar(50) NOT NULL,
  `qui_obs6` varchar(50) NOT NULL,
  `qui_obs7` varchar(50) NOT NULL,
  `qui_obs8` varchar(50) NOT NULL,
  `qui_obs9` varchar(50) NOT NULL,
  `qui_obs10` varchar(50) NOT NULL,
  `sex_exe1` varchar(50) NOT NULL,
  `sex_exe2` varchar(50) NOT NULL,
  `sex_exe3` varchar(50) NOT NULL,
  `sex_exe4` varchar(50) NOT NULL,
  `sex_exe5` varchar(50) NOT NULL,
  `sex_exe6` varchar(50) NOT NULL,
  `sex_exe7` varchar(50) NOT NULL,
  `sex_exe8` varchar(50) NOT NULL,
  `sex_exe9` varchar(50) NOT NULL,
  `sex_exe10` varchar(50) NOT NULL,
  `sex_serie1` varchar(50) NOT NULL,
  `sex_serie2` varchar(50) NOT NULL,
  `sex_serie3` varchar(50) NOT NULL,
  `sex_serie4` varchar(50) NOT NULL,
  `sex_serie5` varchar(50) NOT NULL,
  `sex_serie6` varchar(50) NOT NULL,
  `sex_serie7` varchar(50) NOT NULL,
  `sex_serie8` varchar(50) NOT NULL,
  `sex_serie9` varchar(50) NOT NULL,
  `sex_serie10` varchar(50) NOT NULL,
  `sex_rep1` varchar(50) NOT NULL,
  `sex_rep2` varchar(50) NOT NULL,
  `sex_rep3` varchar(50) NOT NULL,
  `sex_rep4` varchar(50) NOT NULL,
  `sex_rep5` varchar(50) NOT NULL,
  `sex_rep6` varchar(50) NOT NULL,
  `sex_rep7` varchar(50) NOT NULL,
  `sex_rep8` varchar(50) NOT NULL,
  `sex_rep9` varchar(50) NOT NULL,
  `sex_rep10` varchar(50) NOT NULL,
  `sex_obs1` varchar(50) NOT NULL,
  `sex_obs2` varchar(50) NOT NULL,
  `sex_obs3` varchar(50) NOT NULL,
  `sex_obs4` varchar(50) NOT NULL,
  `sex_obs5` varchar(50) NOT NULL,
  `sex_obs6` varchar(50) NOT NULL,
  `sex_obs7` varchar(50) NOT NULL,
  `sex_obs8` varchar(50) NOT NULL,
  `sex_obs9` varchar(50) NOT NULL,
  `sex_obs10` varchar(50) NOT NULL,
  `sab_exe1` varchar(50) NOT NULL,
  `sab_exe2` varchar(50) NOT NULL,
  `sab_exe3` varchar(50) NOT NULL,
  `sab_exe4` varchar(50) NOT NULL,
  `sab_exe5` varchar(50) NOT NULL,
  `sab_exe6` varchar(50) NOT NULL,
  `sab_exe7` varchar(50) NOT NULL,
  `sab_exe8` varchar(50) NOT NULL,
  `sab_exe9` varchar(50) NOT NULL,
  `sab_exe10` varchar(50) NOT NULL,
  `sab_serie1` varchar(50) NOT NULL,
  `sab_serie2` varchar(50) NOT NULL,
  `sab_serie3` varchar(50) NOT NULL,
  `sab_serie4` varchar(50) NOT NULL,
  `sab_serie5` varchar(50) NOT NULL,
  `sab_serie6` varchar(50) NOT NULL,
  `sab_serie7` varchar(50) NOT NULL,
  `sab_serie8` varchar(50) NOT NULL,
  `sab_serie9` varchar(50) NOT NULL,
  `sab_serie10` varchar(50) NOT NULL,
  `sab_rep1` varchar(50) NOT NULL,
  `sab_rep2` varchar(50) NOT NULL,
  `sab_rep3` varchar(50) NOT NULL,
  `sab_rep4` varchar(50) NOT NULL,
  `sab_rep5` varchar(50) NOT NULL,
  `sab_rep6` varchar(50) NOT NULL,
  `sab_rep7` varchar(50) NOT NULL,
  `sab_rep8` varchar(50) NOT NULL,
  `sab_rep9` varchar(50) NOT NULL,
  `sab_rep10` varchar(50) NOT NULL,
  `sab_obs1` varchar(50) NOT NULL,
  `sab_obs2` varchar(50) NOT NULL,
  `sab_obs3` varchar(50) NOT NULL,
  `sab_obs4` varchar(50) NOT NULL,
  `sab_obs5` varchar(50) NOT NULL,
  `sab_obs6` varchar(50) NOT NULL,
  `sab_obs7` varchar(50) NOT NULL,
  `sab_obs8` varchar(50) NOT NULL,
  `sab_obs9` varchar(50) NOT NULL,
  `sab_obs10` varchar(50) NOT NULL,
  PRIMARY KEY (`idExercicio`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------





--
-- Estrutura da tabela `mensalidades`
--

CREATE TABLE IF NOT EXISTS `mensalidades` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `clientes_id` int(5) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `data_pagamento` int(2) NOT NULL,
  `servico_id` int(5) NOT NULL,
  `jan` int(1) NOT NULL DEFAULT '0',
  `fev` int(1) NOT NULL DEFAULT '0',
  `mar` int(1) NOT NULL DEFAULT '0',
  `abr` int(1) NOT NULL DEFAULT '0',
  `mai` int(1) NOT NULL DEFAULT '0',
  `jun` int(1) NOT NULL DEFAULT '0',
  `jul` int(1) NOT NULL DEFAULT '0',
  `ago` int(1) NOT NULL DEFAULT '0',
  `setembro` int(1) NOT NULL DEFAULT '0',
  `outubro` int(1) NOT NULL DEFAULT '0',
  `nov` int(1) NOT NULL DEFAULT '0',
  `dez` int(1) NOT NULL DEFAULT '0',
  `totalpago` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------






--
-- Estrutura da tabela `total_pago_mes`
--

CREATE TABLE IF NOT EXISTS `total_pago_mes` (
  `jan` decimal(10,2) NOT NULL,
  `fev` decimal(10,2) NOT NULL,
  `mar` decimal(10,2) NOT NULL,
  `abr` decimal(10,2) NOT NULL,
  `mai` decimal(10,2) NOT NULL,
  `jun` decimal(10,2) NOT NULL,
  `jul` decimal(10,2) NOT NULL,
  `ago` decimal(10,2) NOT NULL,
  `setembro` decimal(10,2) NOT NULL,
  `outubro` decimal(10,2) NOT NULL,
  `nov` decimal(10,2) NOT NULL,
  `dez` decimal(10,2) NOT NULL,
  `ano` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

INSERT INTO `total_pago_mes` (`jan`, `fev`, `mar`, `abr`, `mai`, `jun`, `jul`, `ago`, `setembro`, `outubro`, `nov`, `dez`, `ano`) VALUES
('0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 2016),
('0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 2017),
('0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 2018),
('0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 2019),
('0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 2020);

