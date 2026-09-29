<?php

require_once(__DIR__ . "/../model/Tarefa.php");

class TarefaService {

    public function validar(Tarefa $tarefa) {
        $erros = [];

        if (empty($tarefa->getTitulo()))
            $erros[] = "Informe o título da tarefa!";

        if (empty($tarefa->getDataEntrega()))
            $erros[] = "Informe a data de entrega!";

        if (!$tarefa->getPrioridade() || !$tarefa->getPrioridade()->getId())
            $erros[] = "Selecione uma prioridade!";

        if (!$tarefa->getTema() || !$tarefa->getTema()->getId())
            $erros[] = "Selecione um tema!";

        return $erros;
    }

    public function excluir($id) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido!");
        }
        $tarefaDao = new TarefaDAO();
        $tarefaDao->excluir($id);
    }
}