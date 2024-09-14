-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/09/2024 às 03:15
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
-- Banco de dados: `whiteventos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `objetivo` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `local` varchar(200) NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `dt_info` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `titulo`, `objetivo`, `local`, `data`, `horario`, `usuario`, `dt_info`, `status`) VALUES
(26, 'Entrega de Prestações de Contas - Agosto/2023', 'Prazos para Entrega de Prestações de Contas Municipais https://www.tcepi.tc.br/fiscalizado/prazos-municipais/', 'TCE/PI', '2024-09-13', '13:00:00', 'Donizete', '2023-01-27', 'pendente'),
(27, 'Entrega de Prestações de Contas - Setembro/2023', 'Prazos para Entrega de Prestações de Contas Municipais https://www.tcepi.tc.br/fiscalizado/prazos-municipais/', 'TCE/PI', '2024-09-01', '13:00:00', 'Donizete', '2023-01-27', 'pendente'),
(28, 'Entrega de Prestações de Contas - Outubro/2023', 'Prazos para Entrega de Prestações de Contas Municipais https://www.tcepi.tc.br/fiscalizado/prazos-municipais/', 'TCE/PI', '2024-01-01', '13:00:00', 'Donizete', '2023-01-27', 'pendente'),
(29, 'Entrega de Prestações de Contas - Novembro/2023', 'Prazos para Entrega de Prestações de Contas Municipais https://www.tcepi.tc.br/fiscalizado/prazos-municipais/', 'TCE/PI', '2024-01-30', '13:00:00', 'Donizete', '2023-01-27', 'pendente'),
(30, 'Entrega de Prestações de Contas - Dezembro/2023', 'Prazos para Entrega de Prestações de Contas Municipais https://www.tcepi.tc.br/fiscalizado/prazos-municipais/', 'TCE/PI', '2024-03-01', '13:00:00', 'Donizete', '2023-01-27', 'pendente'),
(41, 'Reunião Ordinária da Câmara', 'Sessão Ordinária da Câmara de Vereadores.', 'Plenário da Câmara', '2024-10-24', '09:00:00', 'Donizete', '2023-04-17', 'pendente'),
(42, 'Reunião Ordinária da Câmara', 'Sessão Ordinária da Câmara de Vereadores.', 'Plenário da Câmara', '2024-11-07', '09:00:00', 'Donizete', '2023-04-17', 'pendente'),
(43, 'Reunião Ordinária da Câmara', 'Sessão Ordinária da Câmara de Vereadores.', 'Plenário da Câmara', '2023-11-21', '09:00:00', 'Donizete', '2023-04-17', 'pendente'),
(44, 'Reunião Ordinária da Câmara', 'Sessão Ordinária da Câmara de Vereadores.', 'Plenário da Câmara', '2024-09-05', '09:00:00', 'Donizete', '2023-04-17', 'pendente'),
(45, 'Reunião Ordinária da Câmara', 'Sessão Ordinária da Câmara de Vereadores.', 'Plenário da Câmara', '2023-12-19', '09:00:00', 'Donizete', '2023-04-17', 'pendente'),
(62, 'Palestra TRANSFORMENTES 1.0', 'Treinamento com Certificação Digital, ministrado pelo Prof. Hipólito, um dos maiores especialista em neurocomunicação do país. Início do Evento 8:00 horas e duração de 6 horas.', 'Plenário da Câmara Municipal', '2024-09-21', '08:00:00', 'Donizete', '2023-10-05', 'pendente');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
