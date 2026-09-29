-- Criação do banco (opcional)
CREATE DATABASE IF NOT EXISTS task_manager;
USE task_manager;

-- Tabela de prioridades (dados fixos)
CREATE TABLE prioridades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

-- Tabela de matérias/áreas (dados fixos)
CREATE TABLE temas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Tabela principal de tarefas
CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descricao TEXT,
    data_entrega DATE NOT NULL,
    prioridade_id INT NOT NULL,
    tema_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (prioridade_id) REFERENCES prioridades(id),
    FOREIGN KEY (tema_id) REFERENCES temas(id)
);

-- Inserção de dados fixos
INSERT INTO prioridades (nome) VALUES ('Baixa'), ('Média'), ('Alta'), ('Urgente');

INSERT INTO temas (nome) VALUES ('Matemática'), ('Português'), ('História'), 
('Geografia'), ('Física'), ('Química'), ('Biologia'), ('Inglês'), ('Programação'), ('Banco de Dados');