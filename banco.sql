-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/07/2023 às 22:03
-- Versão do servidor: 10.4.27-MariaDB
-- Versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamado`
--

CREATE TABLE `chamado` (
  `ID` int(11) NOT NULL,
  `data` date NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `descricao` text NOT NULL,
  `status` varchar(15) NOT NULL,
  `fila_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `test` int(11) NOT NULL,
  `resposta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chamado`
--

INSERT INTO `chamado` (`ID`, `data`, `titulo`, `descricao`, `status`, `fila_id`, `produto_id`, `usuario_id`, `test`, `resposta`) VALUES
(7, '0000-00-00', 'Pc pegando fogo', 'Começou a pegar fogo', 'pendente', 0, 0, 0, 0, NULL),
(8, '0000-00-00', 'Impressora sem tinta', 'ta sem tinta', 'Finalizado', 0, 0, 0, 0, 'foi colocada a tinta'),
(9, '0000-00-00', 'camera nao funciona', 'não quer ligar mais', 'Finalizado', 0, 0, 0, 0, 'sem bateria, foi carregado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(100) NOT NULL,
  `id_chamado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`ID`, `NOME`, `id_chamado`) VALUES
(16, 'computador', 0),
(17, 'impressora', 0),
(18, 'notebook', 0),
(19, 'Computador', 7),
(20, 'impressora', 8),
(21, 'camera', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `cpf` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`ID`, `nome`, `email`, `usuario`, `senha`, `cpf`, `tipo`) VALUES
(16, 'Milane', 'milanetb@hotmail.com', '', 'senha123', 2147483647, 'usuário'),
(17, 'Lucas', 'lucas@email.com', '', 'senha123', 2147483647, 'técnico'),
(18, 'Eduardo', 'edualbornoz@gmail.com', '', 'senha123', 2147483647, 'usuário');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chamado`
--
ALTER TABLE `chamado`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chamado`
--
ALTER TABLE `chamado`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
