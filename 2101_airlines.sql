-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2016 at 01:50 AM
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
('03535556000170', 'Black Coffe ', 'Black Coffe ME', 'www.cafeine.com', '1123321000', 2),
('05147458000191', 'Bleriot', 'Giovanni e Flávia Restaurante Ltda', 'www.giovanniflavia.com.br', '1138517405', 12),
('07953884000148', 'Droga Raia', 'Raia SA', 'www.drogaraia.com.br', '11695332323', 7),
('12487445000127', 'Méc Dolands', 'Restaurante da Dona Maria Serafina', 'www.oi.com.br', '2322222222', 3),
('12654555000136', 'IntéMais', 'Doceria Até Mais', 'site.com', '1140553502', 3),
('18516423000124', ' BRASIL Souvenirs', ' BRASIL SOUVENIRS ME', 'www.tacaro.com', '1126966666', 5),
('24471167000107', 'ADAB Culinaria Arabe', 'ADAB LTDA', 'www.adab.com.br', '1123468879', 10),
('34872856000179', 'Casa do Pão de Queijo', 'CASA DO PÃO DE QUEIJO LTDA', 'www.casadopaodequeijo.com.br', '1125975146', 10),
('38305914000133', 'SARAIVA LOJA 2', 'Saraiva II LTDA', 'www.saraiva.com.br', '1123356989', 8),
('44190392000174', 'DUTY FREE', 'DUTY Free Guarulhos LTDA', 'www.duty.com', '1132132133', 5),
('51444163000102', 'AVIS - Rent a car', 'AVIS LTDA', 'www.avis.com.br', '1124457409', 11),
('54692359000104', 'Trans Bino', 'Bino Transportes', 'www.cilada.com', NULL, 2),
('57837217000178', 'O Botequim', 'O BOTEQUIM LTDA', 'www.cachaca.com', NULL, 30),
('58745612000193', 'BOB’S', 'Beatriz e Valentina Restaurante ME', 'www.bobs.com.br/', '1635557621', 25),
('58835265000190', 'PIZZA HUT', 'PIZZA HUT SA', 'www.pizzahut.com', '1122244455', 30),
('58855884000146', ' CHILLI BEANS', ' CHILLI BEANS SA', 'www.chillibeans.com.br', '2321321300', 7),
('66192217000159', 'Dollah Here', 'Fast Money LTDA', 'www.gimemoney.com', '1124457400', 15),
('73407366000153', 'Kopenhagen', 'KOPENHAGEN SA', 'www.kopenhagen.com.br', NULL, 10),
('83583395000120', 'Last One Credit', 'Last One Credit SA', 'www.adab.com.br', '1566656565', 30),
('88716601000146', 'RAGAZZO EXPRESS', 'RAGAZZO ', 'www.esfirradaitalia.com', NULL, 30),
('89061163000198', 'Sunglass Hut', 'Sunglass Hut SA', 'www.suhu.com', '1155564545', 8),
('95446425000135', 'CSW EXPRESS', 'Heloisa e Davi Transportes Ltda', 'http://www.csw.com.br', '1136141020', 5),
('97063331000102', 'Strelitzia Flores', 'Strelitzia Flores Enterprise', 'www.sfe.com.br', '1599998656', 35),
('98182622000182', 'On the Rocks  - BAR & GRILL', 'ON THE ROCKS', 'www.naspedras.com', NULL, 30);

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
('03535556000170', 'Café'),
('03535556000170', 'Doces e Sorvetes'),
('03535556000170', 'Fast Food'),
('05147458000191', 'Bar'),
('07953884000148', 'Drogaria'),
('12487445000127', 'Café'),
('12487445000127', 'Fast Food'),
('12654555000136', 'Doces e Sorvetes'),
('18516423000124', 'Moda/Presentes'),
('18516423000124', 'Perfumaria'),
('24471167000107', 'Bar'),
('24471167000107', 'Doces e Sorvetes'),
('24471167000107', 'Restaurante'),
('34872856000179', 'Café'),
('34872856000179', 'Drogaria'),
('38305914000133', 'Livraria'),
('44190392000174', 'Casa de Câmbio'),
('44190392000174', 'Moda/Presentes'),
('44190392000174', 'Outros'),
('44190392000174', 'Perfumaria'),
('51444163000102', 'Aluguel de Carros'),
('54692359000104', 'Transporte de Carga'),
('57837217000178', 'Bar'),
('58745612000193', 'Fast Food'),
('58835265000190', 'Fast Food'),
('58855884000146', 'Moda/Presentes'),
('58855884000146', 'Perfumaria'),
('66192217000159', 'Casa de Câmbio'),
('73407366000153', 'Doces e Sorvetes'),
('83583395000120', 'Banco'),
('88716601000146', 'Fast Food'),
('89061163000198', 'Outros'),
('95446425000135', 'Transporte de Carga'),
('97063331000102', 'Outros'),
('97063331000102', 'Perfumaria'),
('98182622000182', 'Bar'),
('98182622000182', 'Café');

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
('03535556000170', '07:00:00', '23:00:00'),
('05147458000191', '07:00:00', '23:00:00'),
('05147458000191', '10:00:00', '23:59:59'),
('07953884000148', '00:00:00', '23:59:59'),
('12487445000127', '07:00:00', '23:00:00'),
('12654555000136', '00:00:00', '23:59:59'),
('18516423000124', '08:00:00', '18:00:00'),
('24471167000107', '00:00:00', '23:59:59'),
('34872856000179', '00:00:00', '23:59:59'),
('38305914000133', '08:00:00', '18:00:00'),
('44190392000174', '10:00:00', '18:00:00'),
('51444163000102', '00:00:00', '23:59:59'),
('54692359000104', '00:00:00', '23:59:59'),
('57837217000178', '10:00:00', '18:00:00'),
('58745612000193', '00:00:00', '23:59:59'),
('58745612000193', '07:00:00', '23:00:00'),
('58745612000193', '08:00:00', '18:00:00'),
('58835265000190', '10:00:00', '18:00:00'),
('58855884000146', '08:00:00', '22:00:00'),
('66192217000159', '00:00:00', '23:59:59'),
('73407366000153', '07:00:00', '23:00:00'),
('83583395000120', '08:00:00', '18:00:00'),
('88716601000146', '00:00:00', '23:59:59'),
('89061163000198', '08:00:00', '23:59:59'),
('95446425000135', '08:00:00', '18:00:00'),
('97063331000102', '08:00:00', '18:00:00'),
('97063331000102', '10:00:00', '18:00:00'),
('98182622000182', '10:00:00', '23:59:59');

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
('03535556000170', 'Terminal 1', 'Azul', '2003-10-15', NULL),
('05147458000191', 'Terminal 2', 'Astromélia', '2011-10-07', NULL),
('07953884000148', 'Terminal 1', 'Branco', '2006-12-15', NULL),
('12487445000127', 'Terminal 4', 'Abacaxi', '2011-02-22', '2012-03-13'),
('12654555000136', 'Terminal 4', 'Manga', '2015-11-30', NULL),
('18516423000124', 'Terminal 2', 'Gardinia', '2009-05-15', '2010-05-20'),
('24471167000107', 'Terminal 1', 'Preto', '2009-05-15', NULL),
('34872856000179', 'Terminal 1', 'Roxo', '2009-05-15', NULL),
('38305914000133', 'Terminal 4', 'Banana', '2003-10-22', '2010-05-20'),
('44190392000174', 'Terminal 1', 'Laranja', '2006-12-15', NULL),
('51444163000102', 'Terminal 1', 'Amarelo', '2003-10-22', NULL),
('54692359000104', 'Terminal 4', 'Jaca', '2003-06-22', NULL),
('57837217000178', 'Terminal 5', 'Tibia', '2002-02-14', NULL),
('58745612000193', 'Terminal 3', 'Macaco', '2015-04-13', NULL),
('58835265000190', 'Terminal 5', 'Mario Bros', '2003-10-22', NULL),
('58855884000146', 'Terminal 1', 'Verde', '2009-05-15', NULL),
('66192217000159', 'Terminal 2', 'Gloriosa', '2016-05-11', NULL),
('73407366000153', 'Terminal 2', 'Delfim', '2003-10-22', NULL),
('83583395000120', 'Terminal 4', 'Kiwi', '2009-05-15', '2009-05-20'),
('88716601000146', 'Terminal 5', 'Skyrim', '2009-11-15', '2009-05-22'),
('89061163000198', 'Terminal 5', 'Dota', '2009-05-15', NULL),
('95446425000135', 'Terminal 5', 'lol', '2013-10-21', NULL),
('97063331000102', 'Terminal 1', 'Dourado', '2016-05-11', NULL),
('97063331000102', 'Terminal 4', 'Abacate', '2003-10-22', '2009-05-20'),
('98182622000182', 'Terminal 5', 'CS', '2016-11-05', NULL);

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
('33038236691', 'Bino Cilada', 'ehumacilada@bino.com', '15656565455', '54692359000104'),
('40153135778', 'Marcos Eduardo Oliveira Pontes', 'me.op@hotmail.com', '15996650662', '83583395000120'),
('40707587846', 'Mateus Vasconcelos', 'mat.vou_te_hackeei@gmail.com', '11960815422', '05147458000191'),
('41213348765', 'Gerdon Adler Ribeiro Mafra', 'gerdon@hotmail.com', '11987865465', '18516423000124'),
('41915617820', 'Carla Gama', 'carla.gaama@gmail.com', '11981062589', '05147458000191'),
('45643585880', 'Diogo Fernandes de Souza', 'diogo@adab.com', '11999656543', '24471167000107'),
('48128716387', 'Ana Tereza de Vasque', 'ana.vasque@avis.com.br', '11998656544', '51444163000102'),
('52160806510', 'Maria Joaquina', 'mariazinha@gmail.com', '11987701467', '95446425000135'),
('66786607730', 'Ingrid Santos', 'ingrid@gmail.com', '19997052044', '95446425000135'),
('84653519889', 'Jose Lucas Ferreira e Silva', 'jose@bcoffe.com', '19989851111', '03535556000170'),
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
