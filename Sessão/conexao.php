<?php
class Conexao {
    private static $pdo;

    public static function getConexao() {
        if (!isset(self::$pdo)) {
            try {
                // Altere 'root' e '' caso seu usuário/senha do MySQL sejam diferentes
                self::$pdo = new PDO("mysql:host=localhost;dbname=sistema_sessao;charset=utf8", "root", "");
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>