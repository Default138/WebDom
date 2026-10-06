<?php

require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioService {
    private UsuarioDAO $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
    }

    public function validarECadastrar(Usuario $usuario, string $senhaLimpa): array {
        $erros = [];

        if (empty(trim($usuario->getNome() ?? ''))) {
            $erros[] = "Informe o nome do usuário!";
        }

        $email = trim($usuario->getEmail() ?? '');
        if (empty($email)) {
            $erros[] = "Informe o e-mail!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "Informe um e-mail válido!";
        } elseif ($this->usuarioDao->findByEmail($email)) {
            $erros[] = "Este e-mail já está cadastrado no sistema!";
        }

        if (empty(trim($senhaLimpa))) {
            $erros[] = "Informe a senha!";
        } elseif (strlen($senhaLimpa) < 6) {
            $erros[] = "A senha deve conter pelo menos 6 caracteres!";
        }

        if (empty($erros)) {
            //Encripta a senha com Bcrypt (não pergunte, é assim que funciona) e cadastra o usuário
            $hash = password_hash($senhaLimpa, PASSWORD_DEFAULT);
            $usuario->setSenha($hash);
            $this->usuarioDao->insert($usuario);
        }

        return $erros;
    }

    public function excluir(int $idParaExcluir, int $idLogado): array {
        $erros = [];

        if ($idParaExcluir === $idLogado) {
            $erros[] = "Você não pode excluir a sua própria conta enquanto estiver logado!";
            return $erros;
        }

        $usuario = $this->usuarioDao->findById($idParaExcluir);
        if (!$usuario) {
            $erros[] = "Usuário não encontrado!";
            return $erros;
        }

        $this->usuarioDao->delete($idParaExcluir);
        return [];
    }
}