<?php

// Garante que a URL_SISTEMA exista caso o Controller seja invocado fora do header
if (!defined('URL_SISTEMA')) {
    $docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
    $projRoot = str_replace('\\', '/', realpath(__DIR__ . '/../'));
    $webPath = str_replace($docRoot, '', $projRoot);
    define('URL_SISTEMA', rtrim($webPath, '/') . '/');
}

require_once(__DIR__ . "/../service/AuthService.php");

class AuthController {
    private AuthService $authService;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->authService = new AuthService();
    }

    public function login(): array {
        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            $resultado = $this->authService->autenticar($email, $senha);

            if ($resultado['sucesso']) {
                $u = $resultado['usuario'];
                $_SESSION['usuario_logado'] = [
                    'id' => $u->getId(),
                    'nome' => $u->getNome(),
                    'email' => $u->getEmail()
                ];

                header("Location: " . URL_SISTEMA . "index.php");
                exit;
            } else {
                $erros = $resultado['erros'];
            }
        }

        return $erros;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['usuario_logado']);
        session_destroy();
        header("Location: " . URL_SISTEMA . "view/auth/login.php?msg=" . urlencode("Sessão encerrada com sucesso."));
        exit;
    }

    public static function verificarAutenticacao() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario_logado'])) {
            header("Location: " . URL_SISTEMA . "view/auth/login.php?erro=" . urlencode("Acesso negado. Faça login primeiro."));
            exit;
        }
    }
}