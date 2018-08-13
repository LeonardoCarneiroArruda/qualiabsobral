-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13-Ago-2018 às 13:20
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qualiabsobral`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativa`
--

CREATE TABLE `alternativa` (
  `idalternativa` int(11) NOT NULL,
  `descricao` varchar(256) NOT NULL,
  `peso` int(11) DEFAULT NULL,
  `idpergunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE `candidato` (
  `idcandidato` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `instituicao` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_pergunta`
--

CREATE TABLE `grupo_pergunta` (
  `idgrupo_pergunta` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo_pergunta`
--

INSERT INTO `grupo_pergunta` (`idgrupo_pergunta`, `nome`) VALUES
(1, 'Identificação e Características Gerais do Ser'),
(2, 'Recursos Materiais, Procedimentos e Insumos B'),
(3, 'Organização da Atenção à Saúde - 1 Educação e'),
(4, 'Organização da Atenção à Saúde - 2 Organizaçã'),
(5, 'Organização da Atenção à Saúde - 3 Saúde da m'),
(6, 'Organização da Atenção à Saúde - 4 Saúde da C'),
(7, 'Organização da Atenção à Saúde - 5 Saúde do A'),
(8, 'Organização da Atenção à Saúde - 6 Vigilância'),
(9, 'Organização da atenção à saúde - 7 Saúde Buca'),
(10, 'Gestão e Gerenciamento local - 1 Informação, '),
(11, 'Gestão e Gerenciamento Local - 2 Característi');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

CREATE TABLE `pergunta` (
  `idpergunta` int(11) NOT NULL,
  `descricao` varchar(256) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `idgrupo_pergunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontuacao`
--

CREATE TABLE `pontuacao` (
  `idpontuacao` int(11) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  `idpergunta` int(11) NOT NULL,
  `idcandidato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

CREATE TABLE `resposta` (
  `idresposta` int(11) NOT NULL,
  `resposta` varchar(45) DEFAULT NULL,
  `resposta_desc` text,
  `idcandidato` int(11) NOT NULL,
  `idalternativa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `admin` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `senha`, `admin`) VALUES
(1, 'Leonardo Carneiro Arruda', 'leonardo_carneiro2007@hotmail.com', 'qualiabsobral', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`idalternativa`),
  ADD KEY `fk_alternativa_pergunta1_idx` (`idpergunta`);

--
-- Indexes for table `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`idcandidato`);

--
-- Indexes for table `grupo_pergunta`
--
ALTER TABLE `grupo_pergunta`
  ADD PRIMARY KEY (`idgrupo_pergunta`);

--
-- Indexes for table `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`idpergunta`),
  ADD KEY `fk_pergunta_grupo_pergunta_idx` (`idgrupo_pergunta`);

--
-- Indexes for table `pontuacao`
--
ALTER TABLE `pontuacao`
  ADD PRIMARY KEY (`idpontuacao`),
  ADD KEY `fk_pontuacao_pergunta1_idx` (`idpergunta`),
  ADD KEY `fk_pontuacao_candidato1_idx` (`idcandidato`);

--
-- Indexes for table `resposta`
--
ALTER TABLE `resposta`
  ADD PRIMARY KEY (`idresposta`),
  ADD KEY `fk_resposta_candidato1_idx` (`idcandidato`),
  ADD KEY `fk_resposta_alternativa1_idx` (`idalternativa`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `fk_alternativa_pergunta1` FOREIGN KEY (`idpergunta`) REFERENCES `pergunta` (`idpergunta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pergunta`
--
ALTER TABLE `pergunta`
  ADD CONSTRAINT `fk_pergunta_grupo_pergunta` FOREIGN KEY (`idgrupo_pergunta`) REFERENCES `grupo_pergunta` (`idgrupo_pergunta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pontuacao`
--
ALTER TABLE `pontuacao`
  ADD CONSTRAINT `fk_pontuacao_candidato1` FOREIGN KEY (`idcandidato`) REFERENCES `candidato` (`idcandidato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pontuacao_pergunta1` FOREIGN KEY (`idpergunta`) REFERENCES `pergunta` (`idpergunta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `fk_resposta_alternativa1` FOREIGN KEY (`idalternativa`) REFERENCES `alternativa` (`idalternativa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resposta_candidato1` FOREIGN KEY (`idcandidato`) REFERENCES `candidato` (`idcandidato`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
