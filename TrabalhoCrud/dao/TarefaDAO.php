<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Tarefa.php");
require_once(__DIR__ . "/../model/Prioridade.php");
require_once(__DIR__ . "/../model/Tema.php");

class TarefaDAO {

    public function list() {
        $sql = "SELECT t.*, p.nome as prioridade_nome, tm.nome as tema_nome 
                FROM tarefas t
                JOIN prioridades p ON (t.prioridade_id = p.id)
                JOIN temas tm ON (t.tema_id = tm.id)
                ORDER BY t.data_entrega ASC";

        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute();
        $dados = $stm->fetchAll();
        return $this->map($dados);
    }

    public function findById($id) {
        $sql = "SELECT t.*, p.nome as prioridade_nome, tm.nome as tema_nome 
                FROM tarefas t
                JOIN prioridades p ON (t.prioridade_id = p.id)
                JOIN temas tm ON (t.tema_id = tm.id)
                WHERE t.id = :id";

        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();
        $dados = $stm->fetch();
        if (!$dados) return null;
        $tarefas = $this->map([$dados]);
        return $tarefas[0] ?? null;
    }

    public function insert(Tarefa $tarefa) {
        try {
            $sql = "INSERT INTO tarefas (titulo, descricao, data_entrega, prioridade_id, tema_id) 
                    VALUES (:titulo, :descricao, :data_entrega, :prioridade_id, :tema_id)";
            $conn = Connection::getConnection();
            $stm = $conn->prepare($sql);
            $stm->bindValue(':titulo', $tarefa->getTitulo());
            $stm->bindValue(':descricao', $tarefa->getDescricao());
            $stm->bindValue(':data_entrega', $tarefa->getDataEntrega());
            $stm->bindValue(':prioridade_id', $tarefa->getPrioridade()->getId());
            $stm->bindValue(':tema_id', $tarefa->getTema()->getId());
            $stm->execute();
            return "Tarefa inserida com sucesso!";
        } catch (PDOException $e) {
            $erro = "Erro ao inserir tarefa: ";
            if (AMB_DEV) $erro .= "<br>" . $e->getMessage();
            return $erro;
        }
    }

    public function update(Tarefa $tarefa) {
        try {
            $sql = "UPDATE tarefas 
                    SET titulo = :titulo, descricao = :descricao, data_entrega = :data_entrega, 
                        prioridade_id = :prioridade_id, tema_id = :tema_id
                    WHERE id = :id";
            $conn = Connection::getConnection();
            $stm = $conn->prepare($sql);
            $stm->bindValue(':titulo', $tarefa->getTitulo());
            $stm->bindValue(':descricao', $tarefa->getDescricao());
            $stm->bindValue(':data_entrega', $tarefa->getDataEntrega());
            $stm->bindValue(':prioridade_id', $tarefa->getPrioridade()->getId());
            $stm->bindValue(':tema_id', $tarefa->getTema()->getId());
            $stm->bindValue(':id', $tarefa->getId());
            $stm->execute();
            return "Tarefa atualizada com sucesso!";
        } catch (PDOException $e) {
            $erro = "Erro ao atualizar tarefa: ";
            if (AMB_DEV) $erro .= "<br>" . $e->getMessage();
            return $erro;
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM tarefas WHERE id = :id";
            $conn = Connection::getConnection();
            $stm = $conn->prepare($sql);
            $stm->bindValue(':id', $id);
            $stm->execute();
            return "Tarefa excluída com sucesso!";
        } catch (PDOException $e) {
            $erro = "Erro ao excluir tarefa: ";
            if (AMB_DEV) $erro .= "<br>" . $e->getMessage();
            return $erro;
        }
    }

    private function map(array $dados) {
        $tarefas = [];
        foreach ($dados as $d) {
            $tarefa = new Tarefa();
            $tarefa->setId($d['id']);
            $tarefa->setTitulo($d['titulo']);
            $tarefa->setDescricao($d['descricao']);
            $tarefa->setDataEntrega($d['data_entrega']);
            $tarefa->setCriadoEm($d['criado_em']);

            $prioridade = new Prioridade();
            $prioridade->setId($d['prioridade_id']);
            $prioridade->setNome($d['prioridade_nome']);
            $tarefa->setPrioridade($prioridade);

            $tema = new Tema();
            $tema->setId($d['tema_id']);
            $tema->setNome($d['tema_nome']);
            $tarefa->setTema($tema);

            $tarefas[] = $tarefa;
        }
        return $tarefas;
    }
}