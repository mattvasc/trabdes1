-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2016 at 02:23 
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
-- Table structure for table `estabelecimento`
--

CREATE TABLE `estabelecimento` (
  `cnpj` char(14) NOT NULL,
  `nome_fantasia` varchar(256) NOT NULL,
  `razao_social` varchar(256) NOT NULL,
  `n_funcionarios` smallint(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Main table guys';

-- --------------------------------------------------------

--
-- Table structure for table `estabelecimento_categoria`
--

CREATE TABLE `estabelecimento_categoria` (
  `cnpj` varchar(14) NOT NULL,
  `nome` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
  `dia_semana` tinyint(4) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `local`
--

CREATE TABLE `local` (
  `setor` varchar(32) NOT NULL,
  `subsetor` varchar(32) NOT NULL,
  `tamanho` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
