-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2016 at 03:26 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2101_airlines`
--

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
('Perfumaria', ''),
('Restaurante', ''),
('Transporte de Carga', '');

-- --------------------------------------------------------

--
-- Table structure for table `categoria_horario`
--

CREATE TABLE `categoria_horario` (
  `cnpj` varchar(14) NOT NULL,
  `dia_semana` varchar(13) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoria_horario`
--

INSERT INTO `categoria_horario` (`cnpj`, `dia_semana`, `horario_inicio`, `horario_fim`) VALUES
('05147458000191', 'Segunda-Feira', '11:00:00', '24:00:00'),
('05147458000191', 'Sexta-Feira', '07:00:00', '23:00:00'),
('58745612000193', 'Quarta-Feira', '12:00:00', '23:00:00'),
('58745612000193', 'Segunda-Feira', '11:00:00', '24:00:00'),
('58745612000193', 'Sexta-Feira', '07:00:00', '23:00:00'),
('95446425000135', 'Quarta-Feira', '12:00:00', '23:00:00');

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
  `n_funcionarios` smallint(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Main table guys';

--
-- Dumping data for table `estabelecimento`
--

INSERT INTO `estabelecimento` (`cnpj`, `nome_fantasia`, `razao_social`, `site`, `telefone`, `n_funcionarios`, `status`) VALUES
('05147458000191', 'Bleriot', 'Giovanni e Flávia Restaurante Ltda', 'www.giovanniflavia.com.br', '1138517405', 12, 1),
('58745612000193', 'BOB’S', 'Beatriz e Valentina Restaurante ME', 'www.bobs.com.br/', '1635557621', 25, 1),
('95446425000135', 'CSW EXPRESS', 'Heloisa e Davi Transportes Ltda', 'http://www.csw.com.br', '1136141020', 5, 1);

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
('58745612000193', 'Fast Food'),
('95446425000135', 'Transporte de Carga');

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
('05147458000191', 'Terminal 2', 'A', '2011-10-07', NULL),
('58745612000193', 'Terminal 3', 'C', '2015-04-13', NULL),
('95446425000135', 'Terminal 9', 'H', '2013-10-21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
  `dia_semana` varchar(13) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `horario`
--

INSERT INTO `horario` (`dia_semana`, `horario_inicio`, `horario_fim`) VALUES
('Segunda-Feira', '08:00:00', '24:00:00'),
('Segunda-Feira', '11:00:00', '24:00:00'),
('Quarta-Feira', '12:00:00', '23:00:00'),
('Sexta-Feira', '07:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `local`
--

CREATE TABLE `local` (
  `setor` varchar(32) NOT NULL,
  `subsetor` varchar(32) NOT NULL,
  `tamanho` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `local`
--

INSERT INTO `local` (`setor`, `subsetor`, `tamanho`) VALUES
('Terminal 1', 'D', 10),
('Terminal 2', 'A', 25),
('Terminal 2', 'H', 25),
('Terminal 3', 'A', 23),
('Terminal 3', 'C', 20),
('Terminal 4', 'E', 10),
('Terminal 9', 'H', 30),
('Terminal 9', 'I', 10);

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
('40707587846', 'Mateus Vasconcelos', 'mat.vou_te_hackeei@gmail.com', '11960815422', '05147458000191'),
('41915617820', 'Carla Gama', 'carla.gaama@gmail.com', '11981062589', '05147458000191'),
('52160806510', 'Maria Joaquina', 'mariazinha@gmail.com', '11987701467', '95446425000135'),
('66786607730', 'Ingrid Santos', 'ingrid@gmail.com', '19997052044', '95446425000135');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`nome`);

--
-- Indexes for table `categoria_horario`
--
ALTER TABLE `categoria_horario`
  ADD PRIMARY KEY (`cnpj`,`dia_semana`,`horario_inicio`,`horario_fim`);

--
-- Indexes for table `estabelecimento`
--
ALTER TABLE `estabelecimento`
  ADD PRIMARY KEY (`cnpj`);

--
-- Indexes for table `estabelecimento_categoria`
--
ALTER TABLE `estabelecimento_categoria`
  ADD PRIMARY KEY (`cnpj`,`nome`);

--
-- Indexes for table `estabelecimento_local`
--
ALTER TABLE `estabelecimento_local`
  ADD PRIMARY KEY (`cnpj`,`setor`,`subsetor`,`data_inicio`);

--
-- Indexes for table `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`setor`,`subsetor`);

--
-- Indexes for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`cpf`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
