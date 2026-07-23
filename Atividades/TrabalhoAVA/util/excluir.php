<?php

//identifica o carro a ser excluido
$id = $_GET['id'] ?? null;

//validar o ID
if (!$id || !is_numeric($id)) {
    die('ID inexistente');
}

//exclui o carro do banco de dados  
try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrinho', 'root', '');
    $sql = "DELETE FROM Carro WHERE id = :id";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id', $id);
    $stm->execute();
} catch (Exception $e) {
    die('Erro ao excluir carro: ' . $e->getMessage());
}

//redirecionar de volta para a pagina de carros
header("Location: ../carro.php");
exit;