CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insere um usuário padrão (Login: admin@email.com | Senha: admin123)
INSERT INTO usuarios (nome, email, senha) VALUES 
('Administrador', 'admin@email.com', '$2y$10$wN1S1B3x0v6L9xZlE9bO/.VnO5bE8KqJ3H7N2Z1Y0X3W4V5U6T7S2');