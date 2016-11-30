-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2016 at 04:52 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2101_airlines`
--
CREATE DATABASE `2101_airlines`;
USE `2101_airlines`;
-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `nome` varchar(64) NOT NULL,
  `descricao` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`nome`, `descricao`) VALUES
('Aluguel de Carros', ''),
('Banco', ''),
('Bar', ''),
('Café', ''),
('Casa de Câmbio', ''),
('Doces e Sorvetes', ''),
('Drogaria', ''),
('Fast Food', ''),
('Livraria', ''),
('Moda/Presentes', ''),
('Órgão Público', ''),
('Outros', ''),
('Perfumaria', ''),
('Restaurante', ''),
('Transporte de Carga', '');

-- --------------------------------------------------------

--
-- Table structure for table `estabelecimento`
--

CREATE TABLE `estabelecimento` (
  `cnpj` char(14) NOT NULL,
  `nome_fantasia` varchar(256) NOT NULL,
  `razao_social` varchar(256) NOT NULL,
  `site` varchar(100) DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `n_funcionario` smallint(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Main table guys';

--
-- Dumping data for table `estabelecimento`
--

INSERT INTO `estabelecimento` (`cnpj`, `nome_fantasia`, `razao_social`, `site`, `telefone`, `n_funcionario`) VALUES
('05147458000191', 'Bleriot', 'Giovanni e Flávia Restaurante Ltda', 'www.giovanniflavia.com.br', '1138517405', 12),
('12487445000127', 'Méc Dolands', 'Restaurante da Dona Maria Serafina', 'www.oi.com.br', '2322222222', 0),
('12654555000136', 'IntéMais', 'Doceria Até Mais', 'site.com', '1140553502', 0),
('58745612000193', 'BOB’S', 'Beatriz e Valentina Restaurante ME', 'www.bobs.com.br/', '1635557621', 25),
('95446425000135', 'CSW EXPRESS', 'Heloisa e Davi Transportes Ltda', 'http://www.csw.com.br', '1136141020', 5);

-- --------------------------------------------------------

--
-- Table structure for table `estabelecimento_categoria`
--

CREATE TABLE `estabelecimento_categoria` (
  `cnpj` varchar(14) NOT NULL,
  `nome` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estabelecimento_categoria`
--

INSERT INTO `estabelecimento_categoria` (`cnpj`, `nome`) VALUES
('05147458000191', 'Bar'),
('12487445000127', 'Café'),
('12487445000127', 'Fast Food'),
('12654555000136', 'Doces e Sorvetes'),
('58745612000193', 'Fast Food'),
('95446425000135', 'Transporte de Carga');

-- --------------------------------------------------------

--
-- Table structure for table `estabelecimento_horario`
--

CREATE TABLE `estabelecimento_horario` (
  `cnpj` varchar(14) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estabelecimento_horario`
--

INSERT INTO `estabelecimento_horario` (`cnpj`, `horario_inicio`, `horario_fim`) VALUES
('05147458000191', '07:00:00', '23:00:00'),
('05147458000191', '10:00:00', '23:59:59'),
('12487445000127', '07:00:00', '23:00:00'),
('12654555000136', '00:00:00', '23:59:59'),
('58745612000193', '00:00:00', '23:59:59'),
('58745612000193', '07:00:00', '23:00:00'),
('58745612000193', '08:00:00', '18:00:00'),
('95446425000135', '08:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `estabelecimento_local`
--

CREATE TABLE `estabelecimento_local` (
  `cnpj` varchar(14) NOT NULL,
  `setor` varchar(32) NOT NULL,
  `subsetor` varchar(32) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estabelecimento_local`
--

INSERT INTO `estabelecimento_local` (`cnpj`, `setor`, `subsetor`, `data_inicio`, `data_fim`) VALUES
('05147458000191', 'Terminal 2', 'Astromélia', '2011-10-07', NULL),
('12487445000127', 'Terminal 1', 'Azul', '2011-02-22', '2012-03-13'),
('12654555000136', 'Terminal 4', 'Manga', '2015-11-30', NULL),
('58745612000193', 'Terminal 3', 'Macaco', '2015-04-13', NULL),
('95446425000135', 'Terminal 5', 'lol', '2013-10-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `horario`
--

INSERT INTO `horario` (`horario_inicio`, `horario_fim`) VALUES
('00:00:00', '23:59:59'),
('07:00:00', '23:00:00'),
('08:00:00', '18:00:00'),
('08:00:00', '22:00:00'),
('08:00:00', '23:59:59'),
('10:00:00', '18:00:00'),
('10:00:00', '23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `local`
--

CREATE TABLE `local` (
  `setor` varchar(32) NOT NULL,
  `subsetor` varchar(32) NOT NULL,
  `area` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `local`
--

INSERT INTO `local` (`setor`, `subsetor`, `area`) VALUES
('Terminal 1', 'Amarelo', 5),
('Terminal 1', 'Azul', 10),
('Terminal 1', 'Branco', 5),
('Terminal 1', 'Dourado', 25),
('Terminal 1', 'Laranja', 10),
('Terminal 1', 'Preto', 10),
('Terminal 1', 'Roxo', 5),
('Terminal 1', 'Verde', 15),
('Terminal 2', 'Astromélia', 25),
('Terminal 2', 'Cerejeira', 5),
('Terminal 2', 'Cravo', 15),
('Terminal 2', 'Delfim', 15),
('Terminal 2', 'Gardinia', 10),
('Terminal 2', 'Gloriosa', 30),
('Terminal 3', 'Beagle', 15),
('Terminal 3', 'Boxer', 10),
('Terminal 3', 'Chow-Chow', 5),
('Terminal 3', 'Labrador', 3),
('Terminal 3', 'Macaco', 20),
('Terminal 3', 'Pinscher', 23),
('Terminal 3', 'Poodle', 10),
('Terminal 3', 'Pug', 5),
('Terminal 4', 'Abacate', 10),
('Terminal 4', 'Abacaxi', 15),
('Terminal 4', 'Banana', 25),
('Terminal 4', 'Jaca', 10),
('Terminal 4', 'Kiwi', 5),
('Terminal 4', 'Manga', 10),
('Terminal 4', 'Uva', 15),
('Terminal 5', 'CS', 10),
('Terminal 5', 'Dota', 10),
('Terminal 5', 'lol', 30),
('Terminal 5', 'Mario Bros', 5),
('Terminal 5', 'Runscape', 15),
('Terminal 5', 'Skyrim', 15),
('Terminal 5', 'Tibia', 25);

-- --------------------------------------------------------

--
-- Table structure for table `responsavel`
--

CREATE TABLE `responsavel` (
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cnpj` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `responsavel`
--

INSERT INTO `responsavel` (`cpf`, `nome`, `email`, `telefone`, `cnpj`) VALUES
('07183376460', 'João Andrade', 'joao@gmail.com', '1140565628', '58745612000193'),
('26082353870', 'Daniel Bertoldi', 'danidani@teste.com', '1140524514', '12654555000136'),
('40707587846', 'Mateus Vasconcelos', 'mat.vou_te_hackeei@gmail.com', '11960815422', '05147458000191'),
('41915617820', 'Carla Gama', 'carla.gaama@gmail.com', '11981062589', '05147458000191'),
('52160806510', 'Maria Joaquina', 'mariazinha@gmail.com', '11987701467', '95446425000135'),
('66786607730', 'Ingrid Santos', 'ingrid@gmail.com', '19997052044', '95446425000135'),
('94105356380', 'Sobrinha do Dono', 'joleana@gmail.com', '4540553502', '12654555000136');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`nome`);

--
-- Indexes for table `estabelecimento`
--
ALTER TABLE `estabelecimento`
  ADD PRIMARY KEY (`cnpj`);

--
-- Indexes for table `estabelecimento_categoria`
--
ALTER TABLE `estabelecimento_categoria`
  ADD PRIMARY KEY (`cnpj`,`nome`),
  ADD KEY `nome` (`nome`);

--
-- Indexes for table `estabelecimento_horario`
--
ALTER TABLE `estabelecimento_horario`
  ADD PRIMARY KEY (`cnpj`,`horario_inicio`,`horario_fim`),
  ADD KEY `horario_inicio` (`horario_inicio`,`horario_fim`);

--
-- Indexes for table `estabelecimento_local`
--
ALTER TABLE `estabelecimento_local`
  ADD PRIMARY KEY (`cnpj`,`setor`,`subsetor`,`data_inicio`),
  ADD KEY `setor` (`setor`,`subsetor`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`horario_inicio`,`horario_fim`);

--
-- Indexes for table `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`setor`,`subsetor`);

--
-- Indexes for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `fk_cnpj` (`cnpj`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estabelecimento_categoria`
--
ALTER TABLE `estabelecimento_categoria`
  ADD CONSTRAINT `estabelecimento_categoria_ibfk_1` FOREIGN KEY (`cnpj`) REFERENCES `estabelecimento` (`cnpj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estabelecimento_categoria_ibfk_2` FOREIGN KEY (`nome`) REFERENCES `categoria` (`nome`);

--
-- Constraints for table `estabelecimento_horario`
--
ALTER TABLE `estabelecimento_horario`
  ADD CONSTRAINT `estabelecimento_horario_ibfk_1` FOREIGN KEY (`cnpj`) REFERENCES `estabelecimento` (`cnpj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estabelecimento_horario_ibfk_2` FOREIGN KEY (`horario_inicio`,`horario_fim`) REFERENCES `horario` (`horario_inicio`, `horario_fim`);

--
-- Constraints for table `estabelecimento_local`
--
ALTER TABLE `estabelecimento_local`
  ADD CONSTRAINT `estabelecimento_local_ibfk_1` FOREIGN KEY (`cnpj`) REFERENCES `estabelecimento` (`cnpj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estabelecimento_local_ibfk_2` FOREIGN KEY (`setor`,`subsetor`) REFERENCES `local` (`setor`, `subsetor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD CONSTRAINT `fk_cnpj` FOREIGN KEY (`cnpj`) REFERENCES `estabelecimento` (`cnpj`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
