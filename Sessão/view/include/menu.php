<?php
if (!defined('URL_SISTEMA')) {
    $docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
    $projRoot = str_replace('\\', '/', realpath(__DIR__ . '/../../'));
    $webPath = str_replace($docRoot, '', $projRoot);
    define('URL_SISTEMA', rtrim($webPath, '/') . '/');
}

require_once(__DIR__ . "/../../controller/UsuarioController.php");
$isAdmin = UsuarioController::isAdmin();
?>

<nav style="background: #2c3e50; padding: 12px 20px; border-radius: 6px; margin-bottom: 25px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <div>
            <a href="<?= URL_SISTEMA ?>index.php" style="color: #fff; text-decoration: none; font-size: 1.2rem; font-weight: 700;">
                🏫 Sistema de Atividades
            </a>
        </div>

        <ul style="list-style: none; display: flex; gap: 10px; margin: 0; padding: 0; flex-wrap: wrap; align-items: center;">
            
            <!-- ABA VISÍVEL APENAS PARA O ADMINISTRADOR (admin@email.com) -->
            <?php if ($isAdmin): ?>
                <li>
                    <a href="<?= URL_SISTEMA ?>view/usuarios/listar.php"
                        style="color: #f1c40f; text-decoration: none; padding: 8px 15px; border-radius: 4px; transition: background 0.3s; font-weight: bold;"
                        onmouseover="this.style.background='rgba(255,255,255,0.1)'"
                        onmouseout="this.style.background='transparent'">
                        👥 Usuários
                    </a>
                </li>
            <?php endif; ?>

            <li>
                <a href="<?= URL_SISTEMA ?>index.php"
                    style="color: #ecf0f1; text-decoration: none; padding: 8px 15px; border-radius: 4px; transition: background 0.3s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.1)'"
                    onmouseout="this.style.background='transparent'">
                    🏠 Início
                </a>
            </li>

            <li>
                <a href="<?= URL_SISTEMA ?>view/auth/logout.php"
                    style="color: #e74c3c; text-decoration: none; padding: 8px 15px; border-radius: 4px; transition: background 0.3s; font-weight: bold;"
                    onmouseover="this.style.background='rgba(255,255,255,0.1)'"
                    onmouseout="this.style.background='transparent'">
                    🚪 Sair
                </a>
            </li>
        </ul>
    </div>
</nav>