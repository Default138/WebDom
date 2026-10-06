<?php

require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioController {
    private UsuarioDAO $usuarioDao;
    private UsuarioService $usuarioService;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
    }

    // Verifica se o utilizador atual é o Administrador
    public static function isAdmin(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['usuario_logado']) && 
               ($_SESSION['usuario_logado']['email'] ?? '') === 'admin@email.com';
    }

    // Impede o acesso direto pela URL caso não seja admin
    public function verificarAcessoAdmin() {
        if (!self::isAdmin()) {
            header("Location: " . URL_SISTEMA . "index.php?erro=" . urlencode("Acesso negado. Apenas o administrador pode acessar esta área."));
            exit;
        }
    }

    public function listar(): array {
        $this->verificarAcessoAdmin();
        return $this->usuarioDao->listAll();
    }

    public function cadastrar(): array {
        $this->verificarAcessoAdmin();
        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'cadastrar') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            $u = new Usuario();
            $u->setNome($nome);
            $u->setEmail($email);

            $erros = $this->usuarioService->validarECadastrar($u, $senha);

            if (empty($erros)) {
                header("Location: listar.php?msg=" . urlencode("Usuário cadastrado com sucesso!"));
                exit;
            }
        }

        return $erros;
    }

    public function excluir(int $id) {
        $this->verificarAcessoAdmin();
        $idLogado = $_SESSION['usuario_logado']['id'] ?? 0;
        
        $erros = $this->usuarioService->excluir($id, $idLogado);

        if (empty($erros)) {
            header("Location: listar.php?msg=" . urlencode("Usuário excluído com sucesso!"));
            exit;
        } else {
            header("Location: listar.php?erro=" . urlencode(implode(' ', $erros)));
            exit;
        }
    }
}