-- Crie o banco antes se desejar
-- CREATE DATABASE crud_escola DEFAULT CHARACTER SET utf8mb4;
-- USE crud_escola;

CREATE TABLE IF NOT EXISTS clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL,
  telefone VARCHAR(30),
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT,
  preco DECIMAL(10,2) DEFAULT 0.00,
  quantidade INT DEFAULT 0,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dados de exemplo
INSERT INTO clientes (nome, email, telefone) VALUES
('Ana Souza','ana@example.com','(85) 99999-1111'),
('Bruno Lima','bruno@example.com','(85) 98888-2222');

INSERT INTO produtos (nome, descricao, preco, quantidade) VALUES
('Teclado Mecânico','Switches azuis, ABNT2', 230.90, 10),
('Mouse Gamer','8000 DPI', 129.50, 25);
