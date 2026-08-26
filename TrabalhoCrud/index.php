<?php
define('BASE_URL', '/Camargo/Ling_Prog/crudalunos/');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/view/include/header.php");
?>

<div class="container">
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm text-center">
        <h1 class="mb-3">🏫 Bem-vindo ao Sistema de Gestão de Atividades</h1>

        <p class="fs-5 text-secondary mb-4">
            Utilize as opções abaixo para gerenciar o cadastro de atividades.
        </p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="view/atividades/listar.php" class="btn btn-primary btn-lg">
                <i class="bi bi-list-task"></i> Listar Atividades
            </a>

            <a href="view/atividades/inserir.php" class="btn btn-success btn-lg">
                <i class="bi bi-plus-circle"></i> Inserir Atividade
            </a>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/view/include/footer.php");
?>
