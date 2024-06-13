-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/06/2024 às 04:38
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
-- Banco de dados: `kiwi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `email_cliente` varchar(255) DEFAULT NULL,
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `valor`, `imagem`) VALUES
(32, 'Ar-Condicionado Split Inverter II 12000 BTUs Elgin                                         Eco High Wall 45HJFI12C2IA/HJFE12C2NA 220V', 'Classificado com excelência pelo INMETRO, o Ar-condicionado ELGIN Eco Inverter II ostenta uma Classificação A, garantindo economia e menor oscilação de temperatura, ao mesmo tempo que prolonga a vida útil do aparelho. Contribuindo com a preservação do meio ambiente, o gás ecológico R32 é adotado pela Elgin na linha Inverter Eco Star. Esse fluido refrigerante possui baixo potencial de aquecimento global, sendo uma opção sustentável em relação aos modelos anteriores.', 2433.33, 'uploads/arcondicionado-removebg.png'),
(33, 'Roteador Cisco 4300 Series Isr4331/k9 Preto 110v/220v', 'Cor: Preto | Unidades por kit: 1  | Voltagem: 110V/220V | Funções: Roteador | Tipos de conexões: Com fio | Quantidade total de portas: 4 | Quantidade de portas USB: 1', 2254.92, 'uploads/Roteador-removebg - Copia - Copia.png'),
(34, 'Switch 48 Portas Gigabit Gerenciável Hpe Aruba Instant On Jl814a 1830', 'Série: 1830\r\nPortas incluídas: 48 portas RJ-45, 4 portas SFP\r\nTipo de telecomunicação: Store and forward\r\nCapacidade de comutação: 104 Gbps\r\nÉ administrável: Sim\r\nLargura x Profundidade x Altura: 55 cm x 25 cm x 5 cm\r\nPeso: 3,5 kg\r\nÉ montado em rack: Sim', 4359.70, 'uploads/Switch-removebg.png'),
(35, 'Patch Panel Plus Cable, CAT6, 48 Portas, com Guia, CAT.6, Preto - LA-P648', 'Marca: Plus Cable\r\nModelo: LA-P648\r\nCor: Preto\r\nAmbiente de Instalação: Interno\r\nAtende os limites estabelecidos nas normas para CAT.6\r\nIdentificação do número das portas (1 até 48)\r\nSuporte a IEEE 802.3, 1000 BASE T, 1000 BASE TX, EIA/TIA-854, ANSI-EIA/TIA-862, ATM, Vídeo, Sistemas de Automação Predial, e todos os protocolos LAN anteriores\r\nDiâmetro do condutor: 26 a 22 AWG\r\nTipo de cabo: U/UTP Cat.6', 219.99, 'uploads/patch_panel-removebg.png'),
(36, 'Servidores', 'Cor: Preto\r\nProcessador: 3ª geração Intel® Xeon® E-2324G (cache de 8MB, até 4.6GHz)\r\nMemória: 16GB DDR4 (1x16GB) 3200MT/s; Expansível até 64GB (4 slots DIMM)\r\nArmazenamento: SSD de 2x 480GB SATA 6Gbps Cabeada\r\nPlaca de vídeo: Intel® UHD P750 com memória gráfica compartilhada\r\nPortas: 1 porta iDRAC Direct (Micro-AB USB), 1 porta USB 3.0, 1, 5 portas USB 2.0, 1\r\nporta Ethernet, 1 porta serial, 1 porta VGA, 2 portas NIC', 9999.00, 'uploads/Servidor-removebg.png'),
(37, 'Cabo De Rede Cat6 24awg Cx 305m Utp 305 M Metros Vo6', 'Recomendamos nosso produto para Sistema de Cabeamento Estruturado como: Tráfego de voz,\r\ndados e imagens. \r\nPara cabeamento Horizontal ou secundário entre os painéis de\r\ndistribuição - Patch Panels, e os conectores nas áreas de trabalho, sem sistemas que\r\nnecessitem de grande margem de segurança sobre as especificações normalizadas para\r\nsuporte as aplicações futuras.\r\nAproveite uma conexão de internet banda larga em sua empresa ou casa de alta\r\nperformance, mantendo a qualidade e velocidade na transmissão de dados.', 500.00, 'uploads/Cabo_de_rede-removebg.png'),
(38, 'Servidor Rack PowerEdge R450', 'Up to two 2nd Generation Intel® Xeon® Scalable processors, up to 28 cores per processor\r\n24 DDR4 DIMM slots, Supports RDIMM/LRDIMM, speeds up to 2933MT/s, 3TB max\r\nUp to 12 NVDIMM, 192 GB Max\r\nUp to 12 Intel® Optane™ DC persistent memory DCPMM, 6.14TB max, (7.68TB max with DPCMM +\r\nLRDIMM)\r\nSupports registered ECC DDR4 DIMMs only\r\nStorage controllers\r\ndrives max 64TB, or up to 4 x 3.5\" SAS/SATA HDD max 64TB', 15513.67, 'uploads/Servidor_micro1-removebg.png'),
(39, 'NAS QNAP 8 baias Rack TS-864eU-RP-8G-US 2U (Celeron N5095, 8GB, 2x 2.5GbE LAN, HDMI, PCI-e Gen3 x2, 2PSU, s/ HD)', 'conteúdo da embalagem:<br>\r\n- 1x Unidade de armazenamento NAS \r\n- 1x Cabo de rede - 2x Cabos de energia - 32x Parafusos p/ HDD 3.5pol \r\n- 24x Parafusos p/ HDD 2.5pol \r\n- 1x Guia de instalação\r\ndrives suportados: 8x Drives 2.5pol / 3.5pol\r\ninterface (p/ drive): SATA\r\ngarantia: 12 meses de garantia<br>\r\nenc sistema waz: Sim\r\nhot swap: Sim\r\ninterface p/ pc: HDMI', 15550.00, 'uploads/Armazenamento-removebg.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `usertype` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = admin 0 = usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id_user`, `nome`, `email`, `senha`, `usertype`) VALUES
(6, 'admin', 'admin@admin.com', 'admin', 1),
(7, 'cliente', 'cliente@cliente.com', 'cliente', 0),
(8, '', '', '', 0),
(10, 'teste', 'cliente2@cliente.com', 'cliente2', 0),
(11, 'teste2', 'abc123@gmail.com', '123', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `email_cliente` (`email_cliente`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `itens_pedido_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`email_cliente`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
