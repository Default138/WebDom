<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Prioridade.php");

class PrioridadeDAO {

    public function list() {
        $sql = "SELECT * FROM prioridades ORDER BY id";
        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute();
        $dados = $stm->fetchAll();
        return $this->map($dados);
    }

    private function map(array $dados) {
        $prioridades = [];
        foreach ($dados as $d) {
            $p = new Prioridade();
            $p->setId($d['id']);
            $p->setNome($d['nome']);
            $prioridades[] = $p;
        }
        return $prioridades;
    }
}