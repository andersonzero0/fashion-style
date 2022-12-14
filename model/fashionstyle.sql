-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Out-2022 às 00:24
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fashionstyle`
--
CREATE DATABASE fashionstyle;
USE fashionstyle;
-- --------------------------------------------------------

--
-- Estrutura da tabela `info_users`
--

CREATE TABLE `info_users` (
  `id` int(6) UNSIGNED NOT NULL,
  `nomeCompleto` varchar(60) DEFAULT NULL,
  `endereco` varchar(80) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `info_users`
--

INSERT INTO `info_users` (`id`, `nomeCompleto`, `endereco`, `telefone`, `email`) VALUES
(1, 'admin', 'null', '0123456789', 'admin@fashion'),
(2, 'usuario test', 'null', '0987654321', 'usuario@fashion');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id1` int(6) UNSIGNED NOT NULL,
  `client` varchar(20) DEFAULT NULL,
  `produto` varchar(20) DEFAULT NULL,
  `dataPEDIDO` date DEFAULT NULL,
  `horaPEDIDO` time DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(6) UNSIGNED NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `caminhoIMG` varchar(80) DEFAULT NULL,
  `estoque` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `valor`, `caminhoIMG`, `estoque`) VALUES
(3, 'Calção Preto', 99.9, 'download.jpg', 94),
(5, 'Pulôver suéter', 59.9, 'Pulôver suéter da fibra acrílica simples.jpg', 48),
(6, 'Suéter Branco', 50, 'sueter branco.png', 98),
(7, 'Calça Jens Feminina', 100, 'calca_jeans feminina.png', 18),
(8, 'Calça Jens Masculina', 89.9, 'Calca-Jeans-Masculina.jpg', 8),
(9, 'Meia', 29.9, 'meia.jpg', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(6) UNSIGNED NOT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`) VALUES
(1, 'admin', 'fashion@2022'),
(2, 'usuario1', 'usuario@1');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `info_users`
--
ALTER TABLE `info_users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id1`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `info_users`
--
ALTER TABLE `info_users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id1` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
