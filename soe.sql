-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 20-Jun-2019 às 17:25
-- Versão do servidor: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.3.6-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soe`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `nome_aluno` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `nome_responsavel` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email_responsavel` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `id_escola` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id`, `nome_aluno`, `serie`, `nome_responsavel`, `email_responsavel`, `id_escola`) VALUES
(12, 'Marcos Paulo', 5, 'Vania', 'marcos@gmail.com', 0),
(13, 'Denys', 5, 'Francisca', 'francisca@gmail.com', 0),
(14, 'Jefferson', 5, 'Cleonice', 'cleonice@gmail.com', 0),
(44, 'Maria', 5, 'Joao', 'joao@gmail.com', 0),
(46, 'Yasmin', 5, 'Edna', 'edna@gmail.com', 0),
(47, 'ChicÃ³', 1, 'JoÃ£o Grilo', 'naotenho@email.com', 0),
(48, 'Jerbeson', 4, 'Cleonice', 'cleonice@gmail.com', 0),
(49, 'Laura', 5, 'Cleonice', 'cleonice@gmail.com', 2),
(50, 'Liliam', 6, 'Jefferson', 'jeffersontubiba@gmail.com', 2),
(51, 'jerbin', 7, 'Cleonice', 'cleonice@gmail.com', 1),
(52, 'jhklhd', 6, 'jksdhfj', 'jhasljk@klsjdskl', 1),
(53, 'dassad', 5, 'fds', 'fd@sdfs', 1),
(54, 'jskhdfs', 6, 'sdfsdkhj', 'jhsajk@ksjdklsf', 1),
(55, 'Liliam', 6, 'Jefferson', 'jeffersontubiba@gmail.com', 1),
(56, 'hduhu', 6, 'fdjhsjk', 'hjgshj@kshdkshjfs', 1),
(57, 'fdskhfsjk', 6, 'kldhfshf', 'jdkshsjk@kljkdslf', 1),
(58, 'Bruno', 4, 'Jefferson', 'jeffersonsevero08@gmail.com', 1),
(59, 'Bruno', 4, 'Socorro', 'socorro@gmail.com', 9),
(60, 'Privado', 8, 'Bruno Melo', 'brunnomelo70@gmail.com', 1),
(61, 'Jeff', 5, 'Roberto', 'roberto@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `id` int(11) NOT NULL,
  `nome_escola` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `endereco` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `senha` varchar(32) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`id`, `nome_escola`, `endereco`, `email`, `senha`) VALUES
(1, 'EEM Alfredo Machado', 'Centro', 'alfredo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'UFC', 'Cedro', 'ufc@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Alfredo Machado', 'jksadjkah', 'alfredo@gmail.com', 'e150be6d930e116c7ecc7f5bff0c4269'),
(9, 'Alvaro Carneiro', 'Santa Terezinha', 'alvaro@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencias`
--

CREATE TABLE `ocorrencias` (
  `id` int(11) NOT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `id_escola` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ocorrencias`
--

INSERT INTO `ocorrencias` (`id`, `id_aluno`, `serie`, `data`, `id_escola`) VALUES
(51, 55, 6, '2019-06-17', 1),
(52, 58, 4, '2019-06-17', 1),
(53, 44, 7, '2019-01-06', 1),
(54, 51, 7, '2019-06-17', 1),
(55, 60, 8, '2019-06-17', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aluno` (`id_aluno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ocorrencias`
--
ALTER TABLE `ocorrencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `ocorrencias`
--
ALTER TABLE `ocorrencias`
  ADD CONSTRAINT `ocorrencias_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
