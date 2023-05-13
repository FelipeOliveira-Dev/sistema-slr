-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 22-Nov-2019 às 14:37
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `locadora`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluguel`
--

DROP TABLE IF EXISTS `aluguel`;
CREATE TABLE IF NOT EXISTS `aluguel` (
  `idAluguel` int(11) NOT NULL AUTO_INCREMENT,
  `dataDoAluguel` date NOT NULL,
  `dataDev` date NOT NULL,
  `Cliente_idCliente` int(11) NOT NULL,
  `Carros_idCarros` int(11) NOT NULL,
  `funcionarios_id` int(11) NOT NULL,
  PRIMARY KEY (`idAluguel`),
  KEY `fk_Alugel_Cliente1_idx` (`Cliente_idCliente`),
  KEY `fk_Alugel_Carros1_idx` (`Carros_idCarros`),
  KEY `fk_Alugel_funcionarios1_idx` (`funcionarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluguel`
--

INSERT INTO `aluguel` (`idAluguel`, `dataDoAluguel`, `dataDev`, `Cliente_idCliente`, `Carros_idCarros`, `funcionarios_id`) VALUES
(1, '2019-11-14', '2019-11-21', 1, 1, 1),
(2, '2019-11-19', '2019-11-22', 2, 2, 2),
(3, '2019-11-19', '2019-11-29', 1, 3, 3),
(4, '2019-11-21', '2019-11-26', 1, 4, 1),
(5, '2019-11-21', '2019-11-22', 1, 1, 1),
(6, '2019-11-21', '2019-11-23', 1, 3, 1),
(8, '2019-11-21', '2019-11-29', 1, 4, 3),
(9, '2019-11-22', '2019-11-23', 1, 3, 1),
(10, '2019-11-23', '2019-11-28', 3, 4, 3),
(11, '2019-11-22', '2019-11-28', 2, 4, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `carros`
--

DROP TABLE IF EXISTS `carros`;
CREATE TABLE IF NOT EXISTS `carros` (
  `idCarros` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(45) NOT NULL,
  `placa` varchar(45) NOT NULL,
  `cor` varchar(45) NOT NULL,
  `anoFab` int(4) NOT NULL,
  `status` varchar(45) NOT NULL,
  `marca` varchar(45) NOT NULL,
  PRIMARY KEY (`idCarros`),
  UNIQUE KEY `placa_UNIQUE` (`placa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carros`
--

INSERT INTO `carros` (`idCarros`, `modelo`, `placa`, `cor`, `anoFab`, `status`, `marca`) VALUES
(1, 'Corolla - Altis', 'NQN-0996', 'Vermelho', 2019, 'Disponível', 'Toyota'),
(2, 'Corolla - Xei', 'NNN-2255', 'Cinza', 2009, 'Disponível', 'Toyota'),
(3, 'Hilux SW4 - Diamond', 'SWI-2298', 'Vermelho', 2019, 'Disponível', 'Toyota'),
(4, 'SkyLine GT-R R34', 'ASX-2229', 'Laranja', 2002, 'Disponível', 'Nissan'),
(5, 'Onix - LT', 'PNQ-0248', 'Branco', 2017, 'Disponível', 'Chevrolet');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `data_nasc` date NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nome`, `data_nasc`, `cpf`, `telefone`) VALUES
(1, 'Felipe Oliveira', '2003-06-06', '093.301.243-80', '(88) 9223-9325'),
(2, 'Mariana Santiago ', '2016-03-13', '093.301.222-88', '(88) 9309-5577'),
(3, 'Romerio Nogueira da Silva', '1985-02-18', '986.546.357-88', '(88) 9785-2071');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_func` varchar(255) NOT NULL,
  `nivel` int(1) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome_func`, `nivel`, `cpf`, `telefone`, `senha`) VALUES
(1, 'Francisco Felipe Santiago de Oliveira', 1, '093.301.243-80', '(88)9223-9324', '1234'),
(2, 'Marcus Vinicius Linhares de Lima', 2, '123.456.789-11', '(88)9338-3030', '1234'),
(3, 'Francisco Odeliano de ALmeida Chagas', 2, '968.336.548-22', '(88) 9304-5622', '1234'),
(4, 'Luiz Paulo Sousa Ferreira', 2, '091.303.255-27', '(88) 9785-2088', '1234');

-- --------------------------------------------------------

--
-- Stand-in structure for view `func_max_num_alug`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `func_max_num_alug`;
CREATE TABLE IF NOT EXISTS `func_max_num_alug` (
`funcionarios_id` int(11)
,`quant_alug` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `maior_quant_alug`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `maior_quant_alug`;
CREATE TABLE IF NOT EXISTS `maior_quant_alug` (
`maior` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `quantidade_alug`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `quantidade_alug`;
CREATE TABLE IF NOT EXISTS `quantidade_alug` (
`funcionarios_id` int(11)
,`quant_alug` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `func_max_num_alug`
--
DROP TABLE IF EXISTS `func_max_num_alug`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `func_max_num_alug`  AS  select `quantidade_alug`.`funcionarios_id` AS `funcionarios_id`,`quantidade_alug`.`quant_alug` AS `quant_alug` from `quantidade_alug` where (`quantidade_alug`.`quant_alug` = (select `maior_quant_alug`.`maior` from `maior_quant_alug`)) order by `quantidade_alug`.`funcionarios_id` ;

-- --------------------------------------------------------

--
-- Structure for view `maior_quant_alug`
--
DROP TABLE IF EXISTS `maior_quant_alug`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `maior_quant_alug`  AS  select max(`quantidade_alug`.`quant_alug`) AS `maior` from `quantidade_alug` ;

-- --------------------------------------------------------

--
-- Structure for view `quantidade_alug`
--
DROP TABLE IF EXISTS `quantidade_alug`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `quantidade_alug`  AS  select `aluguel`.`funcionarios_id` AS `funcionarios_id`,count(`aluguel`.`funcionarios_id`) AS `quant_alug` from `aluguel` group by `aluguel`.`funcionarios_id` ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluguel`
--
ALTER TABLE `aluguel`
  ADD CONSTRAINT `fk_Alugel_Carros1` FOREIGN KEY (`Carros_idCarros`) REFERENCES `carros` (`idCarros`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Alugel_Cliente1` FOREIGN KEY (`Cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Alugel_funcionarios1` FOREIGN KEY (`funcionarios_id`) REFERENCES `funcionarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
