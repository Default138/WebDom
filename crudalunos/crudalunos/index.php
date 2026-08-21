<?php
define('BASE_URL', '/Camargo/Ling_Prog/crudalunos/');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/view/include/header.php");
?>

<div class="container">
    <h1>🏫 Bem-vindo ao Sistema de Gestão de Alunos</h1>
    
    <p style="font-size: 1.1rem; color: #555; margin: 20px 0 30px 0;">
        Utilize as opções abaixo para gerenciar o cadastro de alunos.
    </p>

    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <a href="view/alunos/listar.php" 
           style="display: inline-block; padding: 12px 30px; background-color: #3498db; color: #fff; border-radius: 5px; text-decoration: none; font-weight: 600;">
            📋 Listar Alunos
        </a>
        
        <a href="view/alunos/inserir.php" 
           style="display: inline-block; padding: 12px 30px; background-color: #27ae60; color: #fff; border-radius: 5px; text-decoration: none; font-weight: 600;">
            ➕ Inserir Aluno
        </a>
    </div>
</div>

<?php
require_once(__DIR__ . "/view/include/footer.php");
?>