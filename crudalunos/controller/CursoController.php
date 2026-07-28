<?php

require_once(__DIR__ . "/../dao/CursoDAO.php");

class CursoController {

    private CursoDAO $cursoDAO;

    public function __construct() {
        $this->cursoDAO = new CursoDAO();
    }

    public function listarCursos(): array {
        return $this->cursoDAO->listar();
    }
/*
    public function buscarPorId(int $id): ?Curso {
        return $this->cursoDAO->buscarPorId($id);
    }
*/
}