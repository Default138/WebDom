<?php

require_once(__DIR__ . "/../dao/AlunoDAO.php");

class AlunoController {

    public function listarAlunos() {
        $alunoDAO = new AlunoDAO();
        return $alunoDAO->listar();
    }
}