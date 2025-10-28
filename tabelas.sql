CREATE TABLE `carro` (
                         `idCarro` int unsigned NOT NULL AUTO_INCREMENT,
                         `motor` varchar(45) DEFAULT NULL,
                         `torque` int DEFAULT NULL,
                         `peso` decimal(10,2) DEFAULT NULL,
                         `espaco` int DEFAULT NULL,
                         `velocidade` int DEFAULT NULL,
                         `Pessoa_idPessoa` int NOT NULL,
                         PRIMARY KEY (`idCarro`),
                         KEY `fk_Carro_Pessoa1_idx` (`Pessoa_idPessoa`),
                         CONSTRAINT `fk_Carro_Pessoa1` FOREIGN KEY (`Pessoa_idPessoa`) REFERENCES `pessoa` (`idPessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `pessoa` (
                          `idPessoa` int NOT NULL AUTO_INCREMENT,
                          `nome` varchar(255) DEFAULT NULL,
                          `telefone` varchar(11) DEFAULT NULL,
                          `endereco` varchar(255) DEFAULT NULL,
                          PRIMARY KEY (`idPessoa`),
                          UNIQUE KEY `idPessoa_UNIQUE` (`idPessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
