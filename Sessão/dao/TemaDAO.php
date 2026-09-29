<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Tema.php");

class TemaDAO {

    public function list() {
        $sql = "SELECT * FROM temas ORDER BY id";
        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute();
        $dados = $stm->fetchAll();
        return $this->map($dados);
    }

    private function map(array $dados) {
        $temas = [];
        foreach ($dados as $d) {
            $t = new Tema();
            $t->setId($d['id']);
            $t->setNome($d['nome']);
            $temas[] = $t;
        }
        return $temas;
    }
}