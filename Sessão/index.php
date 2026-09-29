<?php
// Exibe erros na tela (útil para desenvolvimento)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Requisita e executa o Controlador
require_once 'SessionController.php';

$controller = new SessionController();
$controller->processarRequisicao();
?>