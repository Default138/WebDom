<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Aluno.php");
require_once(__DIR__ . "/../model/Curso.php");

class AlunoDAO
{

    public function list()
    {
        $sql = "SELECT a.*, c.nome nome_curso, c.turno turno_curso 
                FROM alunos a
                JOIN cursos c ON (c.id = a.id_curso)";

        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute();

        $dados = $stm->fetchAll();
        return $this->map($dados);
    }

    public function findById($id)
    {
        $sql = "SELECT a.*, c.nome nome_curso, c.turno turno_curso 
                FROM alunos a
                JOIN cursos c ON (c.id = a.id_curso)
                WHERE a.id = :id";

        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        $dados = $stm->fetch();
        if (!$dados) {
            return null;
        }
        
        $alunos = $this->map([$dados]);
        return $alunos[0] ?? null;
    }

    public function insert(Aluno $aluno)
    {
        try {
            $sql = "INSERT INTO alunos (nome, idade, estrangeiro, id_curso) 
                VALUES (:nome, :idade, :estrangeiro, :id_curso)";

            $conn = Connection::getConnection();
            $stm = $conn->prepare($sql);
            $stm->bindValue(':nome', $aluno->getNome());
            $stm->bindValue(':idade', $aluno->getIdade());
            $stm->bindValue(':estrangeiro', $aluno->getEstrangeiro());
            $stm->bindValue(':id_curso', $aluno->getCurso()->getId());
            $stm->execute();
            return "Aluno inserido com sucesso!";
        } catch (PDOException $e) {
            $erro = "Erro ao inserir aluno: ";
            if(AMB_DEV)
                $erro .= "<br>" . $e->getMessage();
            return $erro;
        }
    }

    public function update(Aluno $aluno)
    {
        try {
            $sql = "UPDATE alunos 
                    SET nome = :nome, idade = :idade, estrangeiro = :estrangeiro, id_curso = :id_curso 
                    WHERE id = :id";

            $conn = Connection::getConnection();
            $stm = $conn->prepare($sql);
            $stm->bindValue(':nome', $aluno->getNome());
            $stm->bindValue(':idade', $aluno->getIdade());
            $stm->bindValue(':estrangeiro', $aluno->getEstrangeiro());
            $stm->bindValue(':id_curso', $aluno->getCurso()->getId());
            $stm->bindValue(':id', $aluno->getId());
            $stm->execute();
            return "Aluno atualizado com sucesso!";
        } catch (PDOException $e) {
            $erro = "Erro ao atualizar aluno: ";
            if(AMB_DEV)
                $erro .= "<br>" . $e->getMessage();
            return $erro;
        }
    }

    public function excluir($id)
    {
        try {
            $sql = "DELETE FROM alunos WHERE id = :id";
            $conn = Connection::getConnection();
            $stm = $conn->prepare($sql);
            $stm->bindValue(':id', $id);
            $stm->execute();
            return "Aluno excluído com sucesso!";
        } catch (PDOException $e) {
            $erro = "Erro ao excluir aluno: ";
            if(AMB_DEV)
                $erro .= "<br>" . $e->getMessage();
            return $erro;
        }
    }

    private function map(array $dados)
    {
        $alunos = array();
        foreach ($dados as $d) {
            $aluno = new Aluno();
            $aluno->setId($d['id']);
            $aluno->setNome($d["nome"]);
            $aluno->setIdade($d["idade"]);
            $aluno->setEstrangeiro($d["estrangeiro"]);

            $curso = new Curso();
            $curso->setId($d["id_curso"]);
            $curso->setNome($d["nome_curso"]);
            $curso->setTurno($d["turno_curso"]);
            $aluno->setCurso($curso);

            array_push($alunos, $aluno);
        }
        return $alunos;
    }
}