<?php
require_once(__DIR__ . "/../../controller/TarefaController.php");

$id = is_numeric($_GET['id']) ? (int)$_GET['id'] : null;

if ($id) {
    try {
        $controller = new TarefaController();
        $controller->excluir($id);
        header("Location: listar.php?msg=Tarefa excluída com sucesso!");
        exit;
    } catch (Exception $e) {
        header("Location: listar.php?erro=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    header("Location: listar.php?erro=ID inválido");
    exit;
}