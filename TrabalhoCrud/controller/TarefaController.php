<?php

require_once(__DIR__ . "/../dao/TarefaDAO.php");
require_once(__DIR__ . "/../service/TarefaService.php");
require_once(__DIR__ . "/../model/Tarefa.php");
require_once(__DIR__ . "/../model/Prioridade.php");
require_once(__DIR__ . "/../model/Tema.php");

class TarefaController {

    private TarefaDAO $tarefaDao;
    private TarefaService $tarefaService;

    public function __construct() {
        $this->tarefaDao = new TarefaDAO();
        $this->tarefaService = new TarefaService();
    }

    public function listar() {
        return $this->tarefaDao->list();
    }

    public function buscarPorId($id) {
        return $this->tarefaDao->findById($id);
    }

    public function inserir(Tarefa $tarefa) {
        $erros = $this->tarefaService->validar($tarefa);
        if (empty($erros)) {
            $this->tarefaDao->insert($tarefa);
        }
        return $erros;
    }

    public function atualizar(Tarefa $tarefa) {
        $erros = $this->tarefaService->validar($tarefa);
        if (empty($erros)) {
            $this->tarefaDao->update($tarefa);
        }
        return $erros;
    }

    public function excluir($id) {
        $this->tarefaService->excluir($id);
    }
}