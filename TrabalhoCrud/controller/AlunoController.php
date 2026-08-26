<?php

require_once(__DIR__ . "/../dao/AlunoDAO.php");
require_once(__DIR__ . "/../service/AlunoService.php");
require_once(__DIR__ . "/../model/Aluno.php");
require_once(__DIR__ . "/../model/Curso.php");

class AlunoController
{

    private AlunoDao $alunoDao;
    private AlunoService $alunoService;

    public function __construct()
    {
        $this->alunoDao = new AlunoDAO();
        $this->alunoService = new AlunoService();
    }

    public function listar()
    {
        return $this->alunoDao->list();
    }

    public function buscarPorId($id)
    {
        return $this->alunoDao->findById($id);
    }

    public function inserir($aluno)
    {
        //validar os dados do formulário
        $erros = $this->alunoService->validar($aluno);

        //persiste o objeto
        if (empty($erros)) {
            $this->alunoDao->insert($aluno);
        }
        return $erros;
    }

    public function atualizar($aluno)
    {
        //validar os dados do formulário
        $erros = $this->alunoService->validar($aluno);

        //atualiza o objeto
        if (empty($erros)) {
            $this->alunoDao->update($aluno);
        }
        return $erros;
    }

    public function excluir($id)
    {
        $this->alunoService->excluir($id);
    }
}