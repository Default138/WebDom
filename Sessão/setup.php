<?php
require_once __DIR__ . '/util/Connection.php';

try {
    $conn = Connection::getConnection();

    $nome = 'Administrador';
    $email = 'admin@email.com';
    $senha = 'admin123';
    
    // Gera o hash real de senha diretamente pelo PHP do seu servidor
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Remove o registro anterior se já existir
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE email = :email");
    $stmt->execute([':email' => $email]);

    // Insere o usuário com o hash válido
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senhaHash
    ]);

    echo "<div style='font-family: Arial; padding: 20px; background: #e8f5e9; border: 1px solid #a5d6a7; border-radius: 8px; max-width: 500px; margin: 40px auto;'>";
    echo "<h2 style='color: #2e7d32; margin-top: 0;'>✅ Usuário configurado com sucesso!</h2>";
    echo "<p><strong>E-mail:</strong> admin@email.com</p>";
    echo "<p><strong>Senha:</strong> admin123</p>";
    echo "<a href='view/auth/login.php' style='display: inline-block; padding: 10px 15px; background: #2e7d32; color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold;'>Ir para o Login</a>";
    echo "</div>";

} catch (Exception $e) {
    echo "<div style='font-family: Arial; padding: 20px; background: #ffebee; color: #c62828; border: 1px solid #ef9a9a; border-radius: 8px; max-width: 500px; margin: 40px auto;'>";
    echo "<h2>❌ Erro ao cadastrar:</h2> " . $e->getMessage();
    echo "</div>";
}
?>