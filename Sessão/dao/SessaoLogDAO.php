<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/SessaoLog.php");

class SessaoLogDAO {

    public function insert(SessaoLog $log) {
        try {
            $sql = "INSERT INTO sessao_logs (acao, valor) VALUES (:acao, :valor)";
            $conn = Connection::getConnection();
            $stm = $conn->prepare($sql);
            $stm->bindValue(':acao', $log->getAcao());
            $stm->bindValue(':valor', $log->getValor());
            $stm->execute();
        } catch (PDOException $e) {
            if (defined('AMB_DEV') && AMB_DEV) {
                echo "Erro ao registrar log: " . $e->getMessage();
            }
        }
    }

    public function listLatest(int $limit = 5) {
        $sql = "SELECT * FROM sessao_logs ORDER BY id DESC LIMIT :limit";
        $conn = Connection::getConnection();
        $stm = $conn->prepare($sql);
        $stm->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stm->execute();
        $dados = $stm->fetchAll();
        return $this->map($dados);
    }

    private function map(array $dados) {
        $logs = [];
        foreach ($dados as $d) {
            $l = new SessaoLog();
            $l->setId($d['id']);
            $l->setAcao($d['acao']);
            $l->setValor($d['valor']);
            $l->setCriadoEm($d['criado_em']);
            $logs[] = $l;
        }
        return $logs;
    }
}