<?php

//Eu refiz isso aqui pq tava muito simples as mensagens de erro

require_once(__DIR__ . "/../model/Tarefa.php");

class TarefaService {

    public function validar(Tarefa $tarefa) {
        $erros = [];

        $titulo = trim($tarefa->getTitulo() ?? '');
        if (empty($titulo)) {
            $erros[] = "Informe o título da tarefa!";
        } elseif (strlen($titulo) < 3) {
            $erros[] = "O título da tarefa deve conter pelo menos 3 caracteres!";
        }

        if (empty($tarefa->getDataEntrega())) {
            $erros[] = "Informe a data de entrega!";
        } else {
            $hoje = date('Y-m-d');
            if ($tarefa->getDataEntrega() < $hoje) {
                $erros[] = "A data de entrega não pode ser anterior à data atual (" . date('d/m/Y') . ")!";
            }
        }

        if (!$tarefa->getPrioridade() || !$tarefa->getPrioridade()->getId()) {
            $erros[] = "Selecione uma prioridade!";
        }

        if (!$tarefa->getTema() || !$tarefa->getTema()->getId()) {
            $erros[] = "Selecione um tema!";
        }

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