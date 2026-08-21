<?php

//pagina para excluir um aluno

require_once(__DIR__ . "/../../controller/AlunoController.php");

//recebe id do aluno a ser excluido
$id = is_numeric($_GET['id']) ? (int)$_GET['id'] : null;

if ($id) {
    try {
        $alunoController = new AlunoController();
        $alunoController->excluir($id);
        
        // Redirecionar para a listagem com mensagem de sucesso
        header("Location: listar.php?msg=Aluno excluído com sucesso!");
        exit;
    } catch (Exception $e) {
        // Em caso de erro, redirecionar com mensagem de erro
        header("Location: listar.php?erro=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // ID inválido
    header("Location: listar.php?erro=ID inválido");
    exit;
}