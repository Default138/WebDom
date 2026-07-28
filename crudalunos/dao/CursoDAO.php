<?php

require_once(__DIR__ . "/AlunoDAO.php");
require_once(__DIR__ . "/../model/Curso.php");
require_once(__DIR__ . "/../util/Connection.php");

class CursoDAO {

    public function listar() {
        $sql = "SELECT * FROM cursos";

        $conn = Connection::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->map($dados);
    }

    private function map($dados) {
        $cursos = [];
        foreach ($dados as $row) {
            $curso = new Curso();
            $curso->setId($row['id']);
            $curso->setNome($row['nome']);
            $curso->setTurno($row['turno']);
            $cursos[] = $curso;
        }
        return $cursos;
    }
}