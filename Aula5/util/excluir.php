<?php

//identificar o livro a ser excluido
$id = $_GET['id'] ?? null;

//validar o ID
if (!$id || !is_numeric($id)) {
    die('ID inexistente');
}

//exclui o livro do banco de dados
try {
    $pdo = new PDO('mysql:host=localhost;dbname=db', 'root', '');
    $sql = "DELETE FROM livros WHERE id = :id";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id', $id);
    $stm->execute();
} catch (Exception $e) {
    die('Erro ao excluir livro: ' . $e->getMessage());
}

//redirecionar de volta para a pagina de livros
header("Location: ../livros.php");
exit;
