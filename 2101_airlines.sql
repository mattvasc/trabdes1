-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 20, 2016 at 08:18 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";

--
-- Database: `2101_airlines`
--
CREATE DATABASE `2101_airlines`;

USE `2101_airlines`;
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
-- Indexes for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `fk_cnpj` (`cnpj`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD CONSTRAINT `fk_cnpj` FOREIGN KEY (`cnpj`) REFERENCES `estabelecimento` (`cnpj`) ON DELETE CASCADE ON UPDATE CASCADE;

