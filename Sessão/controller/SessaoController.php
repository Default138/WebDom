<?php

require_once(__DIR__ . "/../dao/SessaoLogDAO.php");
require_once(__DIR__ . "/../model/SessaoLog.php");

class SessaoController {
    private SessaoLogDAO $logDao;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->logDao = new SessaoLogDAO();
    }

    public function processar() {
        $mensagem = '';
        $tipoMensagem = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $acao = $_POST['acao'] ?? '';
            $valor = trim($_POST['valor'] ?? '');

            switch ($acao) {
                case 'criar': //Criar valor na sessão
                    if (isset($_SESSION['valor_sessao'])) {
                        $mensagem = 'Erro: A sessão já foi criada! Utilize a opção de alterar.';
                        $tipoMensagem = 'danger';
                    } else {
                        if ($valor !== '') {
                            $_SESSION['valor_sessao'] = $valor;
                            $this->registrarLog('Sessão Criada', $valor);
                            $mensagem = 'Valor criado na sessão com sucesso!';
                            $tipoMensagem = 'success';
                        } else {
                            $mensagem = 'Erro: Informe um valor para criar a sessão.';
                            $tipoMensagem = 'danger';
                        }
                    }
                    break;

                case 'alterar': //Alterar o valor da sessão
                    if (!isset($_SESSION['valor_sessao'])) {
                        $mensagem = 'Erro: A sessão ainda não existe! Crie um valor primeiro.';
                        $tipoMensagem = 'danger';
                    } else {
                        if ($valor !== '') {
                            $valorAntigo = $_SESSION['valor_sessao'];
                            $_SESSION['valor_sessao'] = $valor;
                            $this->registrarLog('Sessão Alterada', "De: '$valorAntigo' | Para: '$valor'");
                            $mensagem = 'Valor da sessão alterado com sucesso!';
                            $tipoMensagem = 'success';
                        } else {
                            $mensagem = 'Erro: Informe o novo valor para a sessão.';
                            $tipoMensagem = 'danger';
                        }
                    }
                    break;

                case 'remover': //Remover a sessão (usei o destroy)
                    session_unset();
                    session_destroy();
                    $_SESSION = [];
                    $this->registrarLog('Sessão Removida', 'N/A');
                    $mensagem = 'Sessão removida e destruída com sucesso!';
                    $tipoMensagem = 'success';
                    break;
            }
        }

        //Exibir status e buscar logs
        $sessaoExiste = isset($_SESSION['valor_sessao']);
        $valorSessao = $sessaoExiste ? $_SESSION['valor_sessao'] : null;
        $logs = $this->logDao->listLatest(5);

        return [
            'sessaoExiste' => $sessaoExiste,
            'valorSessao' => $valorSessao,
            'mensagem' => $mensagem,
            'tipoMensagem' => $tipoMensagem,
            'logs' => $logs
        ];
    }

    private function registrarLog(string $acao, ?string $valor) {
        $log = new SessaoLog();
        $log->setAcao($acao);
        $log->setValor($valor);
        $this->logDao->insert($log);
    }
}