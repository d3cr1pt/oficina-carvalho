-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Nov-2020 às 11:09
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `oficina`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `resp_cnpj` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(14) NOT NULL,
  `birthdate` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(9) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `ie` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `customers`
--

INSERT INTO `customers` (`id`, `resp_cnpj`, `name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
(2, 'Empresa', 'Alberto Trevisan', '12844894852', '01/03/2002', 'Rua Quarto Castelli, 297', 'Jd. São Guilherme', '18074-636', 'Sorocabab', 'SP', '15 3000-0000', '15998073707', '', '2020-11-09 21:09:30', '2020-11-14 06:57:32'),
(3, '', 'Maria Morais', '12844894852', '11/03/1971', 'Rua Ary Annunciato', 'Jd Santa Cecilia', '18077080', 'Sorocaba', 'São Paulo', '15991120725', '15991120725', '', '2020-11-14 06:58:23', '2020-11-14 06:58:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mecanico`
--

CREATE TABLE `mecanico` (
  `id` int(11) NOT NULL,
  `resp_cnpj` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(14) NOT NULL,
  `birthdate` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(9) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `ie` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `mecanico`
--

INSERT INTO `mecanico` (`id`, `resp_cnpj`, `name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
(2, 'Mecânica Darli', 'Alberto 2', '12844894852', '01/03/2002', 'Rua Quarto Castelli, 297', 'Jd. São Guilherme', '18074-636', 'Sorocaba', 'SP', '15 3000-0000', '15998073707', '', '2020-11-09 21:09:30', '2020-11-14 06:59:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `os`
--

CREATE TABLE `os` (
  `id` int(11) NOT NULL,
  `dt_registro` datetime DEFAULT NULL,
  `id_veiculo` int(11) DEFAULT NULL,
  `placa` text DEFAULT NULL,
  `id_mecanico` int(11) DEFAULT NULL,
  `nome` text DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `telefone` text DEFAULT NULL,
  `cpf_cnpj` text DEFAULT NULL,
  `id_pagtype` text DEFAULT NULL,
  `services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`services`)),
  `dinheiro` float DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `qt_parcelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `os`
--

INSERT INTO `os` (`id`, `dt_registro`, `id_veiculo`, `placa`, `id_mecanico`, `nome`, `endereco`, `telefone`, `cpf_cnpj`, `id_pagtype`, `services`, `dinheiro`, `obs`, `qt_parcelas`) VALUES
(1, '2020-11-13 13:00:17', 1, 'ABC-0123', 2, 'Alberto Trevisan', 'Rua Quarto Castelli, 297 - Sorocaba, SP', '15998073707', '12844894852', '0', '[{\"servico\":\"Água no Radiador\",\"valor\":\"40.00\"}]', 40, '', 2),
(2, '2020-11-13 13:01:14', 1, 'ABC-0123', 2, 'Alberto Trevisan', 'Rua Quarto Castelli, 297 - Sorocaba, SP', '15998073707', '12844894852', '0', '[{\"servico\":\"Água no Radiador\",\"valor\":\"40.00\"}]', 40, '', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `marca` text DEFAULT NULL,
  `ano_de_fabricacao` int(11) DEFAULT NULL,
  `km` int(11) NOT NULL,
  `modelo` text DEFAULT NULL,
  `placa` varchar(8) DEFAULT NULL,
  `motor` text DEFAULT NULL,
  `numero_eixos` int(11) DEFAULT NULL,
  `potencia_cc` int(11) DEFAULT NULL,
  `quant_portas` int(11) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `marca`, `ano_de_fabricacao`, `km`, `modelo`, `placa`, `motor`, `numero_eixos`, `potencia_cc`, `quant_portas`, `id_cliente`) VALUES
(1, 'Volksvagem', 2019, 0, 'GOL', 'ABC-0123', 'GOL Padrão', 2, 149, 2, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mecanico`
--
ALTER TABLE `mecanico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `os`
--
ALTER TABLE `os`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `mecanico`
--
ALTER TABLE `mecanico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `os`
--
ALTER TABLE `os`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
