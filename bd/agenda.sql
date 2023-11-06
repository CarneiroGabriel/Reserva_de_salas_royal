-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/11/2023 às 14:43
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `agenda`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(220) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `color` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `user` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sala` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `reserva` int(255) NOT NULL,
  `id_index` int(255) NOT NULL,
  `NomeResponsavel` varchar(255) NOT NULL,
  `limpeza` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`, `user`, `sala`, `reserva`, `id_index`, `NomeResponsavel`, `limpeza`) VALUES
(1, 'teste 1', '#3A87AD', '2021-09-26 09:00:00', '2021-09-26 10:00:00', 'selton', 'teste', 0, 1, '', 0),
(2, 'teste 1', '#3A87AD', '2021-09-27 09:00:00', '2021-09-27 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(3, 'teste 1', '#3A87AD', '2021-10-04 09:00:00', '2021-10-04 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(4, 'teste 1', '#3A87AD', '2021-10-11 09:00:00', '2021-10-11 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(5, 'teste 1', '#3A87AD', '2021-10-18 09:00:00', '2021-10-18 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(6, 'teste 1', '#3A87AD', '2021-10-25 09:00:00', '2021-10-25 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(7, 'teste 1', '#3A87AD', '2021-11-01 09:00:00', '2021-11-01 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(8, 'teste 1', '#3A87AD', '2021-11-08 09:00:00', '2021-11-08 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(9, 'teste 1', '#3A87AD', '2021-11-15 09:00:00', '2021-11-15 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(10, 'teste 1', '#3A87AD', '2021-11-22 09:00:00', '2021-11-22 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(11, 'teste 1', '#3A87AD', '2021-11-29 09:00:00', '2021-11-29 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(12, 'teste 1', '#3A87AD', '2021-12-06 09:00:00', '2021-12-06 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(13, 'teste 1', '#3A87AD', '2021-12-13 09:00:00', '2021-12-13 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(14, 'teste 1', '#3A87AD', '2021-12-20 09:00:00', '2021-12-20 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(15, 'teste 1', '#3A87AD', '2021-12-27 09:00:00', '2021-12-27 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(16, 'teste 1', '#3A87AD', '2022-01-03 09:00:00', '2022-01-03 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(17, 'teste 1', '#3A87AD', '2022-01-10 09:00:00', '2022-01-10 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(18, 'teste 1', '#3A87AD', '2022-01-17 09:00:00', '2022-01-17 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(19, 'teste 1', '#3A87AD', '2022-01-24 09:00:00', '2022-01-24 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(20, 'teste 1', '#3A87AD', '2022-01-31 09:00:00', '2022-01-31 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(21, 'teste 1', '#3A87AD', '2022-02-07 09:00:00', '2022-02-07 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(22, 'teste 1', '#3A87AD', '2022-02-14 09:00:00', '2022-02-14 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(23, 'teste 1', '#3A87AD', '2022-02-21 09:00:00', '2022-02-21 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(24, 'teste 1', '#3A87AD', '2022-02-28 09:00:00', '2022-02-28 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(25, 'teste 1', '#3A87AD', '2022-03-07 09:00:00', '2022-03-07 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(26, 'teste 1', '#3A87AD', '2022-03-14 09:00:00', '2022-03-14 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(27, 'teste 1', '#3A87AD', '2022-03-21 09:00:00', '2022-03-21 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(28, 'teste 1', '#3A87AD', '2022-03-28 09:00:00', '2022-03-28 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(29, 'teste 1', '#3A87AD', '2022-04-04 09:00:00', '2022-04-04 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(30, 'teste 1', '#3A87AD', '2022-04-11 09:00:00', '2022-04-11 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(31, 'teste 1', '#3A87AD', '2022-04-18 09:00:00', '2022-04-18 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(32, 'teste 1', '#3A87AD', '2022-04-25 09:00:00', '2022-04-25 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(33, 'teste 1', '#3A87AD', '2022-05-02 09:00:00', '2022-05-02 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(34, 'teste 1', '#3A87AD', '2022-05-09 09:00:00', '2022-05-09 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(35, 'teste 1', '#3A87AD', '2022-05-16 09:00:00', '2022-05-16 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(36, 'teste 1', '#3A87AD', '2022-05-23 09:00:00', '2022-05-23 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(37, 'teste 1', '#3A87AD', '2022-05-30 09:00:00', '2022-05-30 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(38, 'teste 1', '#3A87AD', '2022-06-06 09:00:00', '2022-06-06 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(39, 'teste 1', '#3A87AD', '2022-06-13 09:00:00', '2022-06-13 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(40, 'teste 1', '#3A87AD', '2022-06-20 09:00:00', '2022-06-20 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(41, 'teste 1', '#3A87AD', '2022-06-27 09:00:00', '2022-06-27 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(42, 'teste 1', '#3A87AD', '2022-07-04 09:00:00', '2022-07-04 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(43, 'teste 1', '#3A87AD', '2022-07-11 09:00:00', '2022-07-11 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(44, 'teste 1', '#3A87AD', '2022-07-18 09:00:00', '2022-07-18 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(45, 'teste 1', '#3A87AD', '2022-07-25 09:00:00', '2022-07-25 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(46, 'teste 1', '#3A87AD', '2022-08-01 09:00:00', '2022-08-01 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(47, 'teste 1', '#3A87AD', '2022-08-08 09:00:00', '2022-08-08 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(48, 'teste 1', '#3A87AD', '2022-08-15 09:00:00', '2022-08-15 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(49, 'teste 1', '#3A87AD', '2022-08-22 09:00:00', '2022-08-22 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(50, 'teste 1', '#3A87AD', '2022-08-29 09:00:00', '2022-08-29 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(51, 'teste 1', '#3A87AD', '2022-09-05 09:00:00', '2022-09-05 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(52, 'teste 1', '#3A87AD', '2022-09-12 09:00:00', '2022-09-12 12:00:00', 'selton', 'teste', 0, 2, '', 0),
(54, 'ALinhamente', '#3A87AD', '2023-10-23 14:40:00', '2023-10-23 18:00:00', 'selton', '1', 0, 3, '', 0),
(55, 'teste', '#3A87AD', '2023-10-19 15:46:00', '2023-10-19 18:43:00', 'gabriel', '2', 0, 4, '', 0),
(56, 'teste', '#3A87AD', '2023-10-25 12:00:00', '2023-10-25 13:50:00', 'g.carneiro@royalcargo.com.br', '1', 0, 5, 'Gabriel Carneiro Rodrigues', 0),
(57, 'teste', '#3A87AD', '2023-10-26 15:29:00', '2023-10-26 18:29:00', 'e.jappe@royalcargo.com.br', '1', 0, 6, 'Eduarda Jappe', 0),
(58, 'teste', '#3A87AD', '2023-10-20 13:43:00', '2023-10-20 14:43:00', 'selton', '2', 0, 7, 'Selton Silva', 0),
(59, 'teste', '#3A87AD', '2023-10-27 14:58:00', '2023-10-27 15:58:00', 'selton', '1', 0, 8, 'Selton Silva', 0),
(60, 'teste', '#3A87AD', '2023-10-29 10:03:00', '2023-10-29 18:03:00', 'selton', '1', 0, 9, 'Selton Silva', 0),
(61, 'Alinhamneto', '#3A87AD', '2023-10-24 14:04:00', '2023-10-24 15:04:00', 'selton', '1', 0, 10, 'Selton Silva', 0),
(62, 'Alinhamneto', '#3A87AD', '2023-10-31 14:04:00', '2023-10-31 15:04:00', 'selton', '1', 0, 10, 'Selton Silva', 0),
(63, 'Alinhamneto', '#3A87AD', '2023-11-07 14:04:00', '2023-11-07 15:04:00', 'selton', '1', 0, 10, 'Selton Silva', 0),
(64, 'testew e21', '#3A87AD', '2023-11-01 14:16:00', '2023-11-01 15:16:00', 'selton', '1', 0, 11, 'Selton Silva', 0),
(65, 'teste', '#3A87AD', '2023-11-02 16:29:00', '2023-11-02 17:29:00', 'selton', '1', 0, 12, 'Selton Silva', 0),
(66, 'semanal', '#3A87AD', '2023-11-02 04:29:00', '2023-11-02 06:29:00', 'selton', '1', 0, 13, 'Selton Silva', 0),
(67, 'semanal', '#3A87AD', '2023-11-09 04:29:00', '2023-11-09 06:29:00', 'selton', '1', 0, 13, 'Selton Silva', 0),
(68, 'mensal', '#3A87AD', '2023-10-03 16:30:00', '2023-10-03 17:30:00', 'selton', '1', 0, 14, 'Selton Silva', 0),
(69, 'mensal', '#3A87AD', '2023-11-03 16:30:00', '2023-11-03 17:30:00', 'selton', '1', 0, 14, 'Selton Silva', 0),
(70, 'teste', '#3A87AD', '2023-10-19 15:38:00', '2023-10-19 16:38:00', 'selton', '', 0, 15, 'Selton Silva', 0),
(71, 'teste', '#3A87AD', '2023-10-12 15:38:00', '2023-10-12 16:38:00', 'selton', '', 0, 16, 'Selton Silva', 0),
(72, 'teste', '#3A87AD', '2023-10-12 16:39:00', '2023-10-12 18:39:00', 'selton', '', 0, 17, 'Selton Silva', 0),
(73, 'teste', '#3A87AD', '2023-10-11 15:41:00', '2023-10-11 16:41:00', 'selton', '1', 0, 18, 'Selton Silva', 0),
(74, 'teste', '#3A87AD', '2023-10-19 16:57:00', '2023-10-19 18:57:00', 'selton', '15', 0, 19, 'Selton Silva', 0),
(75, 'teste2', '#3A87AD', '2023-10-20 16:58:00', '2023-10-20 20:02:00', 'selton', '15', 0, 20, 'Selton Silva', 0),
(76, 'teste', '#3A87AD', '2023-10-21 15:59:00', '2023-10-21 16:59:00', 'selton', '15', 0, 21, 'Selton Silva', 0),
(77, 'tster', '#3A87AD', '2023-10-23 16:03:00', '2023-10-23 18:03:00', 'selton', '15', 0, 22, 'Selton Silva', 0),
(78, 'teste', '#3A87AD', '2023-10-11 17:06:00', '2023-10-11 18:06:00', 'selton', '3', 0, 23, 'Selton Silva', 0),
(79, 'teste2', '#3A87AD', '2023-10-25 17:06:00', '2023-10-25 18:06:00', 'selton', '15', 0, 24, 'Selton Silva', 0),
(80, 'tesrt', '#3A87AD', '2023-10-26 18:08:00', '2023-10-26 20:08:00', 'selton', '15', 0, 25, 'Selton Silva', 0),
(81, 'teste4', '#3A87AD', '2023-10-12 12:36:00', '2023-10-12 13:36:00', 'selton', '3', 0, 26, 'Selton Silva', 0),
(82, 'teste 2', '#3A87AD', '2023-10-13 13:36:00', '2023-10-13 15:36:00', 'selton', '3', 0, 27, 'Selton Silva', 0),
(83, 'teste4', '#3A87AD', '2023-10-15 12:41:00', '2023-10-15 14:41:00', 'selton', '3', 0, 28, 'Selton Silva', 0),
(84, 'teste', '#3A87AD', '2023-11-02 10:10:00', '2023-11-02 12:10:00', 'selton', '3', 0, 29, 'Selton Silva', 0),
(85, 'tese3 ', '#3A87AD', '2023-11-03 09:11:00', '2023-11-03 11:11:00', 'selton', '3', 0, 30, 'Selton Silva', 0),
(86, 'teste', '#3A87AD', '2023-11-09 10:25:00', '2023-11-09 12:25:00', 'selton', '3', 0, 31, 'Selton Silva', 0),
(88, 'teste 2', '#3A87AD', '2023-11-09 11:14:00', '2023-11-09 13:14:00', 'selton', '15', 0, 33, 'Selton Silva', 0),
(89, 'teste4 ', '#3A87AD', '2023-11-10 11:15:00', '2023-11-10 14:15:00', 'selton', '15', 0, 34, 'Selton Silva', 0),
(90, 'teste 5', '#3A87AD', '2023-11-11 11:18:00', '2023-11-11 14:18:00', 'selton', '15', 0, 35, 'Selton Silva', 0),
(91, 'teste 6', '#3A87AD', '2023-11-12 10:34:00', '2023-11-12 12:34:00', 'selton', '15', 0, 36, 'Selton Silva', 0),
(92, 'teste', '#3A87AD', '2023-11-03 12:44:00', '2023-11-03 13:44:00', 'selton', '5', 0, 37, 'Selton Silva', 0),
(93, 'teste banco', '#3A87AD', '2023-11-14 11:28:00', '2023-11-14 14:28:00', 'selton', '15', 0, 38, 'Selton Silva', 0),
(97, 'teste bug ', '#3A87AD', '2023-11-16 11:37:00', '2023-11-16 13:37:00', 'selton', '15', 0, 40, 'Selton Silva', 0),
(102, 'teste', '#3A87AD', '2023-11-01 14:41:00', '2023-11-01 17:41:00', 'selton', '5', 0, 44, 'Selton Silva', 0),
(107, 'teste ', '#3A87AD', '2023-11-22 15:19:00', '2023-11-22 17:19:00', 'selton', '15', 1, 49, 'Selton Silva', 1),
(108, 'teste banco 3', '#3A87AD', '2023-11-21 15:20:00', '2023-11-21 16:20:00', 'selton', '15', 1, 50, 'Selton Silva', 3),
(109, 'teste banco ', '#3A87AD', '2023-11-08 15:20:00', '2023-11-08 17:20:00', 'selton', '5', 0, 51, 'Selton Silva', 0),
(110, 'teste feedback', '#3A87AD', '2023-11-26 15:25:00', '2023-11-26 18:25:00', 'selton', '15', 1, 52, 'Selton Silva', 2),
(111, 'Teste ConfimaÃ§Ã£o reserva', '#FFC107', '2023-11-28 15:27:00', '2023-11-28 18:27:00', 'selton', '15', 1, 53, 'Selton Silva', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `salas`
--

CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `lugares` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `teams` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `permissao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `salas`
--

INSERT INTO `salas` (`id`, `titulo`, `valor`, `icon`, `localizacao`, `lugares`, `telefone`, `skype`, `teams`, `descricao`, `permissao`) VALUES
(2, 'Sala America', '1', 'far fa-comments', '1', '1', '1', '1', '1', '1', NULL),
(5, 'Sala africa', '5', '', 'anexos_salas/Africa.jpg', '7', '1', '1', '1', 'Sala laranja', NULL),
(6, 'oceania', '3', 'far fa-comments', 'anexos_salas/Oceania.jpg', '7', '1', '1', '1', 'Sala azul', NULL),
(9, 'Copa', '15', 'far fa-comments', 'anexos_salas/Copa.jpg', '500=', '1', '1', '1', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `senha` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipo` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nome` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`, `tipo`, `nome`) VALUES
(1, 'selton', '123', 'adm', 'Selton Silva'),
(2, 'gabriel', '123', 'user', 'Gabriel'),
(3, 'g.carneiro@royalcargo.com.br', '9827', 'user', 'Gabriel Carneiro Rodrigues'),
(6, 'e.jappe@royalcargo.com.br', '12345', 'user', 'Eduarda Jappe'),
(7, 'amigo@royalcargo.com.br', '12345', 'user', 'amigo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
