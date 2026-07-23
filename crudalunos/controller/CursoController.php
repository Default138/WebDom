<?php

require_once(__DIR__ . "/../dao/CursoDAO.php");

class CursoController {

    public function listarCursos() {
        $cursoDAO = new CursoDAO();
        return $cursoDAO->listar();
    }
}

