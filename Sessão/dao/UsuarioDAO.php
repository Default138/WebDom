<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO {

    public function findByEmail(string $email): ?Usuario {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->bindValue(':email', $email);
        $stm->execute();
        $d = $stm->fetch();

        if (!$d) return null;

        return $this->map([$d])[0];
    }

    public function findById(int $id): ?Usuario {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();
        $d = $stm->fetch();

        if (!$d) return null;

        return $this->map([$d])[0];
    }

    public function listAll(): array {
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute();
        $dados = $stm->fetchAll();
        return $this->map($dados);
    }

    public function insert(Usuario $usuario): bool {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->bindValue(':nome', $usuario->getNome());
        $stm->bindValue(':email', $usuario->getEmail());
        $stm->bindValue(':senha', $usuario->getSenha());
        return $stm->execute();
    }

    public function delete(int $id): bool {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        return $stm->execute();
    }

    private function map(array $dados): array {
        $usuarios = [];
        foreach ($dados as $d) {
            $u = new Usuario();
            $u->setId($d['id']);
            $u->setNome($d['nome']);
            $u->setEmail($d['email']);
            $u->setSenha($d['senha']);
            $u->setCriadoEm($d['criado_em']);
            $usuarios[] = $u;
        }
        return $usuarios;
    }
}