<?php

//Mostrar erros do PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Configurar essas variáveis de acordo com o seu ambiente
define("DB_HOST", "localhost");
define("DB_NAME", "task_manager");
define("DB_USER", "root");
define("DB_PASSWORD", "");

//configuração ambiente
define("AMB_DEV", false);

//URL base do projeto (usada no menu.php para montar os links)
define("BASE_URL", "/Camargo/Ling_Prog/crudalunos/");