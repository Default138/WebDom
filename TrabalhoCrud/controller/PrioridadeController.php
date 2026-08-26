<?php

require_once(__DIR__ . "/../dao/PrioridadeDAO.php");

class PrioridadeController {

    public function listar() {
        $dao = new PrioridadeDAO();
        return $dao->list();
    }
}