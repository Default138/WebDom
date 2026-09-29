<?php
?>
<nav style="background: #2c3e50; padding: 12px 20px; border-radius: 6px; margin-bottom: 25px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <div>
            <a href="<?= defined('BASE_URL') ? BASE_URL : '/' ?>" style="color: #fff; text-decoration: none; font-size: 1.2rem; font-weight: 700;">
                🏫 Sistema de Atividades
            </a>
        </div>

        <ul style="list-style: none; display: flex; gap: 10px; margin: 0; padding: 0; flex-wrap: wrap;">
            <li>
                <a href="<?= defined('BASE_URL') ? BASE_URL : '/' ?>" 
                   style="color: #ecf0f1; text-decoration: none; padding: 8px 15px; border-radius: 4px; transition: background 0.3s;"
                   onmouseover="this.style.background='rgba(255,255,255,0.1)'" 
                   onmouseout="this.style.background='transparent'">
                    🚪 Sair
                </a>
            </li>
            <li>
                <a href="<?= defined('BASE_URL') ? BASE_URL : '/' ?>index.php" 
                   style="color: #ecf0f1; text-decoration: none; padding: 8px 15px; border-radius: 4px; transition: background 0.3s;"
                   onmouseover="this.style.background='rgba(255,255,255,0.1)'" 
                   onmouseout="this.style.background='transparent'">
                    🏠 Início
                </a>
            </li>
        </ul>
    </div>
</nav>