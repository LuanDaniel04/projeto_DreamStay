-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/07/2025 às 18:08
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dreamstay`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `avaliacao` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `usuario_id`, `nome`, `localizacao`, `preco`, `avaliacao`, `descricao`, `imagem`, `tags`) VALUES
(25, 1, 'Beira rio', 'porto alegre', 12.00, '9.8 - ótima', 'asdasd', 'uploads/68778f3076373.jpg', 'melhores avaliados,talvez voce goste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `data_favorito` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `favoritos`
--

INSERT INTO `favoritos` (`id`, `usuario_id`, `hotel_id`, `data_favorito`) VALUES
(3, 7, 25, '2025-07-16 16:02:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `tipo` enum('admin','visitante') NOT NULL DEFAULT 'visitante',
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `register`
--

INSERT INTO `register` (`id`, `nome`, `email`, `senha`, `tipo`, `foto_perfil`) VALUES
(1, 'Adm', 'admin@admin.com', '123456', 'admin', 'uploads/68779d6846ebc_entrada.jpg'),
(5, 'Paulo Henrique Silva da Silva', 'teste@teste.com', '123456', 'visitante', NULL),
(6, 'Paulo Henrique Silva da Silva', 'email@email.com', '123456', 'visitante', NULL),
(7, 'Paulo Henrique Silva da Silva', 'paullohsds@gmail.com', '123456', 'visitante', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario_id` (`usuario_id`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`hotel_id`);

--
-- Índices de tabela `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `register` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
