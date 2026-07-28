<?php

require_once(__DIR__ . "/../dao/AlunoDAO.php");
require_once(__DIR__ . "/../model/Aluno.php");

class AlunoController {

    private AlunoDAO $alunoDAO;

    public function __construct() {
        $this->alunoDAO = new AlunoDAO();
    }

    public function listarAlunos(): array {
        return $this->alunoDAO->listar();
    }

/*    
    public function buscarPorId(int $id): ?Aluno {
        return $this->alunoDAO->buscarPorId($id);
    }

    public function salvar(Aluno $aluno): bool {
        if ($aluno->getId()) {
            return $this->alunoDAO->atualizar($aluno);
        } else {
            return $this->alunoDAO->inserir($aluno);
        }
    }

    public function excluir(int $id): bool {
        return $this->alunoDAO->excluir($id);
    }
*/
}