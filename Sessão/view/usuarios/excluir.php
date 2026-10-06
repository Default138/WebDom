<?php
require_once(__DIR__ . "/../../controller/UsuarioController.php");

$id = is_numeric($_GET['id'] ?? null) ? (int)$_GET['id'] : null;

if ($id) {
    $controller = new UsuarioController();
    $controller->excluir($id);
} else {
    header("Location: listar.php?erro=" . urlencode("ID de usuário inválido!"));
    exit;
}