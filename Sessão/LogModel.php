<?php
require_once 'conexao.php';

class LogModel {
    // Salva o registro da ação no banco
    public function registrarAcao($acao, $valor = null) {
        $pdo = Conexao::getConexao();
        $sql = "INSERT INTO logs_sessao (acao, valor) VALUES (:acao, :valor)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':acao', $acao);
        $stmt->bindValue(':valor', $valor);
        $stmt->execute();
    }

    // Busca os últimos 5 logs para exibir na tela
    public function obterLogs() {
        $pdo = Conexao::getConexao();
        $sql = "SELECT * FROM logs_sessao ORDER BY data_hora DESC LIMIT 5";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>