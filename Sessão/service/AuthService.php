<?php

require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class AuthService {
    private UsuarioDAO $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
    }

    public function autenticar(string $email, string $senha): array {
        $erros = [];

        if (empty(trim($email))) {
            $erros[] = "Informe o e-mail!";
        }
        if (empty(trim($senha))) {
            $erros[] = "Informe a senha!";
        }

        if (!empty($erros)) {
            return ['sucesso' => false, 'erros' => $erros, 'usuario' => null];
        }

        $usuario = $this->usuarioDao->findByEmail($email);

        // Compara a senha informada com o hash salvo no banco
        if (!$usuario || !password_verify($senha, $usuario->getSenha())) {
            return [
                'sucesso' => false,
                'erros' => ["E-mail ou senha incorretos!"],
                'usuario' => null
            ];
        }

        return ['sucesso' => true, 'erros' => [], 'usuario' => $usuario];
    }
}