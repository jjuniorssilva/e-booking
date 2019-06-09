-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Jun-2019 às 17:00
-- Versão do servidor: 10.3.15-MariaDB
-- versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `reserva_equip`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_check`
--

CREATE TABLE `t_check` (
  `cod_check` int(11) NOT NULL,
  `info_check` varchar(150) NOT NULL,
  `data_check` date NOT NULL,
  `t_reserva_cod_reserva` int(11) NOT NULL,
  `t_usuario_cod_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_item`
--

CREATE TABLE `t_item` (
  `cod_item` int(20) NOT NULL,
  `t_tipo` varchar(45) DEFAULT NULL,
  `valor_item` double DEFAULT NULL,
  `conteudo_item` varchar(150) DEFAULT NULL,
  `ativo_item` varchar(1) NOT NULL DEFAULT '1',
  `data_cadastro` datetime NOT NULL,
  `usuario_cadastro` varchar(15) NOT NULL,
  `obs_item` varchar(150) DEFAULT NULL,
  `descricao_item` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `t_item`
--

INSERT INTO `t_item` (`cod_item`, `t_tipo`, `valor_item`, `conteudo_item`, `ativo_item`, `data_cadastro`, `usuario_cadastro`, `obs_item`, `descricao_item`) VALUES
(122, 'eletro', 8, 'dfs', '1', '2019-06-09 00:00:00', 'deuimar', 'dfsdf', 'dsddsg'),
(123, 'eletro', 4, 'ffknbfdnfdkg', '1', '2019-06-12 00:00:00', '1', 'fddgg', 'vsdsvds');

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_nivel`
--

CREATE TABLE `t_nivel` (
  `cod_nivel` int(11) NOT NULL,
  `nome_nivel` varchar(45) NOT NULL,
  `descricao_nivel` varchar(100) NOT NULL,
  `ativo_nivel` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `t_nivel`
--

INSERT INTO `t_nivel` (`cod_nivel`, `nome_nivel`, `descricao_nivel`, `ativo_nivel`) VALUES
(123, 'usuario', 'faz coisas', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_reserva`
--

CREATE TABLE `t_reserva` (
  `cod_reserva` int(11) NOT NULL,
  `data_reserva` date NOT NULL,
  `data_inicio` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `data_fim` date NOT NULL,
  `hora_fim` time NOT NULL,
  `desc_reserva` varchar(150) NOT NULL,
  `cancela_reserva` varchar(1) NOT NULL,
  `t_item_cod_item` int(20) NOT NULL,
  `t_usuario_cod_usuario` int(11) NOT NULL,
  `t_check_cod_check` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_rotina`
--

CREATE TABLE `t_rotina` (
  `cod_rotina` int(11) NOT NULL,
  `nome_rotina` varchar(45) NOT NULL,
  `descricao_rotina` varchar(100) NOT NULL,
  `ativa_rotina` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_rotina_has_t_nivel`
--

CREATE TABLE `t_rotina_has_t_nivel` (
  `t_rotina_cod_rotina` int(11) NOT NULL,
  `t_nivel_cod_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `t_usuario`
--

CREATE TABLE `t_usuario` (
  `cod_usuario` int(11) NOT NULL,
  `login_usuario` varchar(15) NOT NULL,
  `senha_usuario` varchar(45) NOT NULL,
  `nome_usuario` varchar(45) NOT NULL,
  `ativo_usuario` varchar(1) NOT NULL DEFAULT '1',
  `data_cadastro` datetime NOT NULL,
  `usu_cadastro` varchar(15) NOT NULL,
  `t_nivel_cod_nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `t_usuario`
--

INSERT INTO `t_usuario` (`cod_usuario`, `login_usuario`, `senha_usuario`, `nome_usuario`, `ativo_usuario`, `data_cadastro`, `usu_cadastro`, `t_nivel_cod_nivel`) VALUES
(1, 'posei', '202cb962ac59075b964b07152d234b70', 'deuimar', '1', '2019-06-12 00:00:00', '1', 123);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `t_check`
--
ALTER TABLE `t_check`
  ADD PRIMARY KEY (`cod_check`,`t_reserva_cod_reserva`,`t_usuario_cod_usuario`),
  ADD KEY `fk_t_check_t_usuario1_idx` (`t_usuario_cod_usuario`);

--
-- Índices para tabela `t_item`
--
ALTER TABLE `t_item`
  ADD PRIMARY KEY (`cod_item`),
  ADD UNIQUE KEY `cod_item_UNIQUE` (`cod_item`);

--
-- Índices para tabela `t_nivel`
--
ALTER TABLE `t_nivel`
  ADD PRIMARY KEY (`cod_nivel`);

--
-- Índices para tabela `t_reserva`
--
ALTER TABLE `t_reserva`
  ADD PRIMARY KEY (`cod_reserva`,`t_item_cod_item`,`t_usuario_cod_usuario`),
  ADD KEY `fk_t_reserva_t_item1_idx` (`t_item_cod_item`),
  ADD KEY `fk_t_reserva_t_usuario1_idx` (`t_usuario_cod_usuario`),
  ADD KEY `fk_t_reserva_t_check1_idx` (`t_check_cod_check`);

--
-- Índices para tabela `t_rotina`
--
ALTER TABLE `t_rotina`
  ADD PRIMARY KEY (`cod_rotina`);

--
-- Índices para tabela `t_rotina_has_t_nivel`
--
ALTER TABLE `t_rotina_has_t_nivel`
  ADD PRIMARY KEY (`t_rotina_cod_rotina`,`t_nivel_cod_nivel`),
  ADD KEY `fk_t_rotina_has_t_nivel_t_nivel1_idx` (`t_nivel_cod_nivel`),
  ADD KEY `fk_t_rotina_has_t_nivel_t_rotina_idx` (`t_rotina_cod_rotina`);

--
-- Índices para tabela `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD PRIMARY KEY (`cod_usuario`,`t_nivel_cod_nivel`),
  ADD UNIQUE KEY `login_usuario_UNIQUE` (`login_usuario`),
  ADD KEY `fk_t_usuario_t_nivel1_idx` (`t_nivel_cod_nivel`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `t_nivel`
--
ALTER TABLE `t_nivel`
  MODIFY `cod_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de tabela `t_rotina`
--
ALTER TABLE `t_rotina`
  MODIFY `cod_rotina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `t_usuario`
--
ALTER TABLE `t_usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `t_check`
--
ALTER TABLE `t_check`
  ADD CONSTRAINT `fk_t_check_t_usuario1` FOREIGN KEY (`t_usuario_cod_usuario`) REFERENCES `t_usuario` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `t_reserva`
--
ALTER TABLE `t_reserva`
  ADD CONSTRAINT `fk_t_reserva_t_check1` FOREIGN KEY (`t_check_cod_check`) REFERENCES `t_check` (`cod_check`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_reserva_t_item1` FOREIGN KEY (`t_item_cod_item`) REFERENCES `t_item` (`cod_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_reserva_t_usuario1` FOREIGN KEY (`t_usuario_cod_usuario`) REFERENCES `t_usuario` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `t_rotina_has_t_nivel`
--
ALTER TABLE `t_rotina_has_t_nivel`
  ADD CONSTRAINT `fk_t_rotina_has_t_nivel_t_nivel1` FOREIGN KEY (`t_nivel_cod_nivel`) REFERENCES `t_nivel` (`cod_nivel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_t_rotina_has_t_nivel_t_rotina` FOREIGN KEY (`t_rotina_cod_rotina`) REFERENCES `t_rotina` (`cod_rotina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD CONSTRAINT `fk_t_usuario_t_nivel1` FOREIGN KEY (`t_nivel_cod_nivel`) REFERENCES `t_nivel` (`cod_nivel`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
