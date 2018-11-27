-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 20-Nov-2018 às 21:44
-- Versão do servidor: 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eusei`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(1, 'amor'),
(2, 'Educaçao'),
(3, 'Historia'),
(4, 'Marketing'),
(5, 'Outros'),
(6, 'Ficção'),
(7, 'Clarqui Quente'),
(8, 'Administrador'),
(9, 'Usuario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas`
--

DROP TABLE IF EXISTS `curtidas`;
CREATE TABLE IF NOT EXISTS `curtidas` (
  `idUsuario` int(11) NOT NULL,
  `idResposta` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idResposta`),
  KEY `fk3_idx` (`idUsuario`),
  KEY `fk4_idx` (`idResposta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `denunciarpergunta`
--

DROP TABLE IF EXISTS `denunciarpergunta`;
CREATE TABLE IF NOT EXISTS `denunciarpergunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `idPergunta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk17_idx` (`idPergunta`),
  KEY `fk18_idx` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `denunciarpergunta`
--

INSERT INTO `denunciarpergunta` (`id`, `titulo`, `descricao`, `idPergunta`, `idUsuario`, `data`) VALUES
(8, 'irrelevante', 'categoria errada', 16, 48, '2018-11-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `denunciarresposta`
--

DROP TABLE IF EXISTS `denunciarresposta`;
CREATE TABLE IF NOT EXISTS `denunciarresposta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `idResposta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk7_idx` (`idResposta`),
  KEY `fk8_idx` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `denunciarresposta`
--

INSERT INTO `denunciarresposta` (`id`, `titulo`, `descricao`, `idResposta`, `idUsuario`, `data`) VALUES
(1, 'duplicidade', 'a duas respostas iguais', 27, 48, '2018-11-03'),
(2, 'Bolsominio', 'Facistas!!!', 42, 49, '2018-11-06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `descurtidas`
--

DROP TABLE IF EXISTS `descurtidas`;
CREATE TABLE IF NOT EXISTS `descurtidas` (
  `idUsuario` int(11) NOT NULL,
  `idResposta` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idResposta`),
  KEY `fk51_idx` (`idResposta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

DROP TABLE IF EXISTS `pergunta`;
CREATE TABLE IF NOT EXISTS `pergunta` (
  `idPergunta` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` text NOT NULL,
  `data` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  PRIMARY KEY (`idPergunta`),
  KEY `fk1_idx` (`idUsuario`),
  KEY `fk2_idx` (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pergunta`
--

INSERT INTO `pergunta` (`idPergunta`, `pergunta`, `data`, `idUsuario`, `idcategoria`) VALUES
(7, 'O que a palavra legend significa em português ?', '2018-11-03', 21, 7),
(9, 'Quando meu Notebook vai chegar ?', '2018-11-03', 21, 7),
(10, 'Quais os principais autores do Barroco no Brasil?', '2018-11-04', 21, 5),
(11, 'Quanto tempo a luz do Sol demora para chegar à Terra?', '2018-11-04', 35, 2),
(15, 'poque o mac mini esta mais barato ?', '2018-11-06', 43, 5),
(16, 'Quem  e melhor no CS ?????/Vinicius ou Diogo', '2018-11-06', 44, 5),
(19, 'Porque a Sony e tao foda?', '2018-11-17', 49, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

DROP TABLE IF EXISTS `resposta`;
CREATE TABLE IF NOT EXISTS `resposta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resposta` text NOT NULL,
  `idPergunta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk11_idx` (`idUsuario`),
  KEY `fk12_idx` (`idPergunta`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `resposta`
--

INSERT INTO `resposta` (`id`, `resposta`, `idPergunta`, `idUsuario`, `data`) VALUES
(25, 'Lenda', 7, 21, '2018-11-03'),
(26, 'Não Sei', 9, 21, '2018-11-03'),
(27, 'Lenda', 7, 35, '2018-11-03'),
(30, 'Gregório de Matos, Bento Teixeira e Manuel Botelho de Oliveira', 10, 21, '2018-11-04'),
(32, '8 minutos', 11, 35, '2018-11-04'),
(39, 'confia na AWP', 16, 21, '2018-11-06'),
(42, 'Depois que o Bolsonario foi eleito o dolar comecou a cair.', 15, 49, '2018-11-06'),
(43, 'Porque lancaram a nova geracaoa', 15, 49, '2018-11-06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `dataNasc` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `dataCad` date NOT NULL,
  `ativo` enum('Sim','Nao') NOT NULL,
  `tipo` enum('usu','adm','esp') NOT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `login` varchar(60) NOT NULL,
  `senha` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk13_idx` (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `dataNasc`, `email`, `imagem`, `dataCad`, `ativo`, `tipo`, `idcategoria`, `login`, `senha`) VALUES
(21, 'vinicius', '0000-00-00', 'v@hotmail.com', '1540074696', '0000-00-00', 'Sim', 'adm', 1, 'vnc', '202cb962ac59075b964b07152d234b70'),
(35, 'BadDolly', '2005-10-05', 'dolly@hotmail.com', '1540685921', '2018-10-28', 'Sim', 'usu', 1, 'dolly', '202cb962ac59075b964b07152d234b70'),
(43, 'gustavo dellatorre', '1996-08-15', 'gustavo@gmail.com', '1541540921', '2018-11-06', 'Sim', 'usu', 9, 'gds', '6d2016d49f225ce67a56c52613ff73f3'),
(44, 'Robson', '1988-08-27', 'robinho2708@hotmail.com', '1541541233', '2018-11-06', 'Sim', 'usu', 9, 'Robson', '69727fef27a967e0f67cfece8fd225b8'),
(48, 'DIOGO VANDERLAN PEREIRA DOS SANTOS', '1993-05-07', 'diogo.vanderlan@gmail.com', '1542487946', '2018-11-17', 'Sim', 'adm', 8, 'vanderlan', '202cb962ac59075b964b07152d234b70'),
(49, 'fernando', '1993-08-07', 'fer@email.com', '1542504759', '2018-11-17', 'Sim', 'usu', 1, 'fer', '81dc9bdb52d04dc20036dbd8313ed055'),
(50, 'Fernando', '1993-08-07', 'fer.user@email.com', '1542505724', '2018-11-17', 'Sim', 'esp', 8, 'correa', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk4` FOREIGN KEY (`idResposta`) REFERENCES `resposta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `denunciarpergunta`
--
ALTER TABLE `denunciarpergunta`
  ADD CONSTRAINT `fk17` FOREIGN KEY (`idPergunta`) REFERENCES `pergunta` (`idPergunta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk18` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `denunciarresposta`
--
ALTER TABLE `denunciarresposta`
  ADD CONSTRAINT `fk7` FOREIGN KEY (`idResposta`) REFERENCES `resposta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk8` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `descurtidas`
--
ALTER TABLE `descurtidas`
  ADD CONSTRAINT `fk50` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk51` FOREIGN KEY (`idResposta`) REFERENCES `resposta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pergunta`
--
ALTER TABLE `pergunta`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `fk11` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk12` FOREIGN KEY (`idPergunta`) REFERENCES `pergunta` (`idPergunta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk13` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
