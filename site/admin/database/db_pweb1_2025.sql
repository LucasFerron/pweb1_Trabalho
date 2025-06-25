-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para bancotrabalhopweb1
CREATE DATABASE IF NOT EXISTS `bancotrabalhopweb1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bancotrabalhopweb1`;

-- Copiando estrutura para tabela bancotrabalhopweb1.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela bancotrabalhopweb1.categoria: ~7 rows (aproximadamente)
INSERT INTO `categoria` (`id`, `nome`) VALUES
	(1, 'Peito'),
	(2, 'Perna'),
	(3, 'Triceps'),
	(4, 'Abdomen'),
	(5, 'Bíceps'),
	(6, 'Ombro'),
	(7, 'Costas');

-- Copiando estrutura para tabela bancotrabalhopweb1.exercicios
CREATE TABLE IF NOT EXISTS `exercicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `categoria_id` int DEFAULT NULL,
  `equipamento` varchar(50) DEFAULT NULL,
  `nivel` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela bancotrabalhopweb1.exercicios: ~11 rows (aproximadamente)
INSERT INTO `exercicios` (`id`, `nome`, `categoria_id`, `equipamento`, `nivel`, `descricao`) VALUES
	(1, 'Supino', 1, 'Banco de Supino', '1', 'teste'),
	(2, 'Supino Inclinado', 1, 'Banco Inclinado do Supino', '2', 'Banco inclinado com suportes laterais e uma barra para anilhas de peso'),
	(3, 'Crucifixo', 1, 'No rack', '1', 'Exercício na máquina sentado'),
	(4, 'Flexão de Braço', 1, 'Solo', '2', 'Flexão estilo militar'),
	(5, 'Tríceps Francês', 1, 'Polia Baixa', '1', 'Crossover Unilateral'),
	(6, 'Crucifixo Inverso', 7, 'No rack', '1', 'No rack sentado'),
	(7, 'Puxada Pronada', 7, 'Polia Alta', '1', 'No banco da remada'),
	(8, 'Remada Baixa', 7, 'Polia Baixa', '1', 'Banco da remada'),
	(9, 'Rosca Direta', 5, 'Barra W', '2', 'Sentado'),
	(10, 'Rosca Alternada', 5, 'Halter', '2', 'Em pé'),
	(11, 'Rosca Inversa', 5, 'Polia Baixa', '1', 'Na polia');

-- Copiando estrutura para tabela bancotrabalhopweb1.treino
CREATE TABLE IF NOT EXISTS `treino` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` text,
  `usuario_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela bancotrabalhopweb1.treino: ~3 rows (aproximadamente)
INSERT INTO `treino` (`id`, `nome`, `descricao`, `usuario_id`) VALUES
	(1, 'Treino A', 'Peito e Tríceps', 1),
	(2, 'Treino B', 'Costas e Bíceps', 1),
	(3, 'Treino A', 'Peito e Tríceps', 2);

-- Copiando estrutura para tabela bancotrabalhopweb1.treino_exercicios
CREATE TABLE IF NOT EXISTS `treino_exercicios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `treino_id` int DEFAULT NULL,
  `exercicios_id` int DEFAULT NULL,
  `series` int DEFAULT NULL,
  `repeticoes` varchar(50) DEFAULT NULL,
  `carga` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela bancotrabalhopweb1.treino_exercicios: ~12 rows (aproximadamente)
INSERT INTO `treino_exercicios` (`id`, `treino_id`, `exercicios_id`, `series`, `repeticoes`, `carga`) VALUES
	(1, 1, 1, 3, '12', 30),
	(2, 1, 2, 4, '10', 20),
	(3, 1, 3, 3, '20', 3),
	(4, 1, 4, 4, '10', 0),
	(5, 1, 5, 4, '12', 4),
	(6, 2, 6, 3, '15', 4),
	(7, 2, 7, 4, '12', 9),
	(8, 2, 8, 4, '10', 7),
	(9, 2, 9, 3, '12', 14),
	(10, 2, 10, 4, '10', 14),
	(11, 2, 11, 4, '10', 3),
	(12, 4, 5, 3, '12', 4);

-- Copiando estrutura para tabela bancotrabalhopweb1.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `senha` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `cpf` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` enum('aluno','professor') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela bancotrabalhopweb1.usuario: ~3 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `nome`, `senha`, `cpf`, `telefone`, `email`, `cargo`) VALUES
	(1, 'Angelo Antonio Lucietto', '123', '10509254918', '49991676199', 'angelolucietto@gmail.com', 'professor'),
	(2, 'Teste Silva', '$2y$10$cSjAHX1ZfEqC2bUK4ccUs.6HYoBo8nhM3Hinby/UQumI0uAmEb/gu', '111.222.333-44', '4999999999', 'teste.silva@gmail.com', 'aluno'),
	(9, 'Admin', '$2y$10$mOMd0xz3BTBmt1.RRQWpzOwzFyWQl4CkBzbmcs4jDLjsFnGps.Ni2', '123.123.123-12', '(49) 99840-6066', 'admin@gmail.com', 'professor');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
