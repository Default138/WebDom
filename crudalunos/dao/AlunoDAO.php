<?php

require_once(__DIR__ . "/../model/Aluno.php");
require_once(__DIR__ . "/../model/Curso.php");
require_once(__DIR__ . "/../util/Connection.php");

class AlunoDAO
{

    public function listar()
    {
        $sql = "SELECT a.*, c.nome nome_curso, c.turno turno_curso
                FROM alunos a
                JOIN cursos c ON (c.id = a.id_curso)";

        $conn = Connection::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->map($dados);
    }

    private function map(array $dados)
    {
        $alunos = [];
        foreach ($dados as $d) {
            $aluno = new Aluno();
            $aluno->setId($d['id']);
            $aluno->setNome($d['nome']);
            $aluno->setIdade($d['idade']);
            $aluno->setEstrangeiro($d['estrangeiro']);

            $curso = new Curso();
            $curso->setId($d['id_curso']);
            $curso->setNome($d['nome_curso']);
            $curso->setTurno($d['turno_curso']);
            $aluno->setCurso($curso);

            array_push($alunos, $aluno);
        }
        return $alunos;
    }
}