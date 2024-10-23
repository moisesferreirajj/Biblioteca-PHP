-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para biblioteca
CREATE DATABASE IF NOT EXISTS `biblioteca` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `biblioteca`;

-- Copiando estrutura para tabela biblioteca.autor
CREATE TABLE IF NOT EXISTS `autor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(150) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.autor: ~1 rows (aproximadamente)
INSERT INTO `autor` (`id`, `autor`, `imagem`, `estado`) VALUES
	(4, 'C. J. Tudor', '20240628195551.jpg', 1),
	(5, 'Dan Brown', '20240629040925.jpg', 1);

-- Copiando estrutura para tabela biblioteca.configuracao
CREATE TABLE IF NOT EXISTS `configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.configuracao: ~0 rows (aproximadamente)
INSERT INTO `configuracao` (`id`, `nome`, `telefone`, `endereco`, `email`, `foto`) VALUES
	(1, 'E.E.B. Plácido Olímpio de Oliveira', '(47) 3461-1546', 'R. Dom Bosco, 68 - Bom Retiro, Joinville', 'placidoolimpio@gmail.com', 'logo.png');

-- Copiando estrutura para tabela biblioteca.detalhe_permissoes
CREATE TABLE IF NOT EXISTS `detalhe_permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_permissao` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_permissao` (`id_permissao`),
  CONSTRAINT `detalhe_permissoes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `detalhe_permissoes_ibfk_2` FOREIGN KEY (`id_permissao`) REFERENCES `permissoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.detalhe_permissoes: ~2 rows (aproximadamente)
INSERT INTO `detalhe_permissoes` (`id`, `id_usuario`, `id_permissao`) VALUES
	(5, 2, 11),
	(6, 10, 11);

-- Copiando estrutura para tabela biblioteca.editora
CREATE TABLE IF NOT EXISTS `editora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editora` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.editora: ~3 rows (aproximadamente)
INSERT INTO `editora` (`id`, `editora`, `estado`) VALUES
	(1, 'Editora NOVA', 1),
	(3, 'Editora Intrínseca', 1),
	(4, 'Editora Arqueiro', 1);

-- Copiando estrutura para tabela biblioteca.emprestimo
CREATE TABLE IF NOT EXISTS `emprestimo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_estudante` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `fecha_emprestimo` date NOT NULL,
  `fecha_devolucao` date NOT NULL,
  `quantidade` int(11) NOT NULL,
  `observacao` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id_estudante` (`id_estudante`),
  KEY `id_livro` (`id_livro`),
  CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`id_estudante`) REFERENCES `estudante` (`id`),
  CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.emprestimo: ~1 rows (aproximadamente)
INSERT INTO `emprestimo` (`id`, `id_estudante`, `id_livro`, `fecha_emprestimo`, `fecha_devolucao`, `quantidade`, `observacao`, `estado`) VALUES
	(5, 1, 5, '2024-06-28', '2024-06-29', 1, '', 0),
	(6, 4, 6, '2024-06-29', '2024-06-30', 1, 'Livro em perfeitas condições, por favor entregar no prazo!', 0);

-- Copiando estrutura para tabela biblioteca.estudante
CREATE TABLE IF NOT EXISTS `estudante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `turma` varchar(255) NOT NULL,
  `endereco` text NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.estudante: ~2 rows (aproximadamente)
INSERT INTO `estudante` (`id`, `codigo`, `dni`, `nome`, `turma`, `endereco`, `telefone`, `estado`) VALUES
	(1, '4552473491', '201', 'Moises Ferreira', 'Ensino Medio 2-01', 'Bom Retiro, Joinville, SC', '47991270120', 1),
	(4, '4552473492', '202', 'Mark Stolf', 'Ensino Medio 2-02', 'Bom Retiro, Joinville SC', '4799127019', 1);

-- Copiando estrutura para tabela biblioteca.genero
CREATE TABLE IF NOT EXISTS `genero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genero` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.genero: ~5 rows (aproximadamente)
INSERT INTO `genero` (`id`, `genero`, `estado`) VALUES
	(1, 'Ação', 1),
	(2, 'Comédia', 1),
	(3, 'Romance', 1),
	(4, 'Aventura', 1),
	(5, 'Suspense', 1);

-- Copiando estrutura para tabela biblioteca.livro
CREATE TABLE IF NOT EXISTS `livro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` text NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_editora` int(11) NOT NULL,
  `ano_edicao` date NOT NULL,
  `id_genero` int(11) NOT NULL,
  `num_pagina` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id_autor` (`id_autor`),
  KEY `id_genero` (`id_genero`),
  KEY `id_editora` (`id_editora`),
  CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id`),
  CONSTRAINT `livro_ibfk_2` FOREIGN KEY (`id_editora`) REFERENCES `editora` (`id`),
  CONSTRAINT `livro_ibfk_3` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.livro: ~2 rows (aproximadamente)
INSERT INTO `livro` (`id`, `titulo`, `quantidade`, `id_autor`, `id_editora`, `ano_edicao`, `id_genero`, `num_pagina`, `descricao`, `imagem`, `estado`) VALUES
	(5, 'O Homem de Giz', 2, 4, 3, '2018-01-01', 5, 272, 'A história apresentada neste livro se inicia em 1986, na cidade de Anderbury, onde existia um grupo de quatro amigos (três meninos e uma menina) por volta de seus doze anos de idade. Esse grupo estava constantemente buscando algo para passar o tempo e também fugindo dos valentões que os perseguiam. Nessa época, criaram um código secreto, o qual consistia em desenhos a giz de homenzinhos rabiscados no asfalto. Entretanto, um desenho misterioso os levou até um corpo desmembrado e espalhado num bosque… É, esses acontecimentos decorrem-se logo em suas primeiras páginas, tornando a leitura deste livro cada vez mais cativante e intrigante no âmbito da descoberta do que levou a essa morte.', '20240629034237.jpg', 1),
	(6, 'O Codigo Da Vinci', 1, 5, 4, '2021-04-15', 3, 560, 'O Código Da Vinci é um romance policial que tem como protagonista um simbologista norte-americano. Através da obra de Leonardo Da Vinci, onde encontra várias mensagens codificadas, tenta arranjar provas para desvendar um segredo com centenas de anos. No livro surgem instituições como a Opus Dei e o Priorado do Sião.', '20240629041046.jpg', 1);

-- Copiando estrutura para tabela biblioteca.permissoes
CREATE TABLE IF NOT EXISTS `permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.permissoes: ~11 rows (aproximadamente)
INSERT INTO `permissoes` (`id`, `nome`, `tipo`) VALUES
	(1, 'Livros', 1),
	(2, 'Autor', 2),
	(3, 'Editora', 3),
	(4, 'Usuarios', 4),
	(5, 'Configuracao', 5),
	(6, 'Estudantes', 6),
	(7, 'Generos', 7),
	(8, 'Relatorios', 8),
	(9, 'Emprestimo', 9),
	(10, 'Admin', 10),
	(11, 'Bibliotecario', 11);

-- Copiando estrutura para tabela biblioteca.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `chave` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela biblioteca.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `usuario`, `nome`, `chave`, `estado`) VALUES
	(1, 'moises', 'Moises Ferreira', '597f6434ea15170676af0bdfb7cf799514a14ebf8e108ce85f950eb1b065c3ff', 1),
	(2, 'mark', 'Mark Stolf', '597f6434ea15170676af0bdfb7cf799514a14ebf8e108ce85f950eb1b065c3ff', 1),
	(10, 'PedroMaioshi', 'Pedro Maioshi', '9f14e819feff0a5f82028c68d04e7abd04b06534fd51a9d1920b4152490bc6df', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
