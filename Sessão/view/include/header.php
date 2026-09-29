<?php
// Calcula dinamicamente a URL base web do projeto
//Mesma coisa, não me pergunte
if (!defined('URL_SISTEMA')) {
    $docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
    $projRoot = str_replace('\\', '/', realpath(__DIR__ . '/../../'));
    $webPath = str_replace($docRoot, '', $projRoot);
    define('URL_SISTEMA', rtrim($webPath, '/') . '/');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Atividades</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <main>
        <?php require_once __DIR__ . '/menu.php'; ?>