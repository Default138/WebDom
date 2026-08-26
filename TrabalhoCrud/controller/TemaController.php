<?php

require_once(__DIR__ . "/../dao/TemaDAO.php");

class TemaController {

    public function listar() {
        $dao = new TemaDAO();
        return $dao->list();
    }
}