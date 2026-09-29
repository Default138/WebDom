<?php
require_once 'LogModel.php';

class SessionController {
    private $logModel;

    public function __construct() {
        // Inicia a sessão aqui, no ponto de controle
        session_start();
        $this->logModel = new LogModel();
    }

    public function processarRequisicao() {
        $mensagem = '';
        $tipoMensagem = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $acao = $_POST['acao'] ?? '';
            $valor = trim($_POST['valor'] ?? '');

            switch ($acao) {
                case 'criar': // a) Criar valor
                    if (isset($_SESSION['valor_sessao'])) {
                        $mensagem = 'Erro: A sessão já foi criada! Utilize a opção de alterar.';
                        $tipoMensagem = 'erro';
                    } else {
                        if ($valor !== '') {
                            $_SESSION['valor_sessao'] = $valor;
                            $this->logModel->registrarAcao('Sessão Criada', $valor);
                            $mensagem = 'Valor criado na sessão com sucesso!';
                            $tipoMensagem = 'sucesso';
                        } else {
                            $mensagem = 'Erro: Informe um valor para criar a sessão.';
                            $tipoMensagem = 'erro';
                        }
                    }
                    break;

                case 'alterar': // b) Alterar valor
                    if (!isset($_SESSION['valor_sessao'])) {
                        $mensagem = 'Erro: A sessão ainda não existe! Crie um valor primeiro.';
                        $tipoMensagem = 'erro';
                    } else {
                        if ($valor !== '') {
                            $valorAntigo = $_SESSION['valor_sessao'];
                            $_SESSION['valor_sessao'] = $valor;
                            $this->logModel->registrarAcao('Sessão Alterada', "De: $valorAntigo | Para: $valor");
                            $mensagem = 'Valor da sessão alterado com sucesso!';
                            $tipoMensagem = 'sucesso';
                        } else {
                            $mensagem = 'Erro: Informe o novo valor para a sessão.';
                            $tipoMensagem = 'erro';
                        }
                    }
                    break;

                case 'remover': // c) Remover sessão
                    session_unset();
                    session_destroy();
                    $_SESSION = [];
                    $this->logModel->registrarAcao('Sessão Removida', 'N/A');
                    $mensagem = 'Sessão removida e destruída com sucesso!';
                    $tipoMensagem = 'sucesso';
                    break;
            }
        }

        // Busca o status atual e os logs do banco para enviar à View
        $sessaoExiste = isset($_SESSION['valor_sessao']);
        $valorSessao = $sessaoExiste ? $_SESSION['valor_sessao'] : null;
        $logs = $this->logModel->obterLogs();

        // Chama a View
        require_once 'view.php';
    }
}
?>