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
            $valorEntrada = trim($_POST['valor'] ?? '');
            $tipoEstrutura = $_POST['tipo_estrutura'] ?? 'string';

            switch ($acao) {
                case 'criar':
                    if (isset($_SESSION['valor_sessao'])) {
                        $mensagem = 'Erro: A sessão já foi criada! Utilize a opção de alterar.';
                        $tipoMensagem = 'danger';
                    } else {
                        if ($valorEntrada !== '') {
                            $valorFinal = $this->prepararValor($valorEntrada, $tipoEstrutura);
                            $_SESSION['valor_sessao'] = $valorFinal;
                            
                            $this->registrarLog('Sessão Criada (' . ucfirst($tipoEstrutura) . ')', $this->formatarParaLog($valorFinal));
                            $mensagem = 'Valor criado na sessão com sucesso!';
                            $tipoMensagem = 'success';
                        } else {
                            $mensagem = 'Erro: Informe um valor para criar a sessão.';
                            $tipoMensagem = 'danger';
                        }
                    }
                    break;

                case 'alterar':
                    if (!isset($_SESSION['valor_sessao'])) {
                        $mensagem = 'Erro: A sessão ainda não existe! Crie um valor primeiro.';
                        $tipoMensagem = 'danger';
                    } else {
                        if ($valorEntrada !== '') {
                            $valorAntigo = $this->formatarParaLog($_SESSION['valor_sessao']);
                            $valorFinal = $this->prepararValor($valorEntrada, $tipoEstrutura);
                            $_SESSION['valor_sessao'] = $valorFinal;

                            $this->registrarLog('Sessão Alterada (' . ucfirst($tipoEstrutura) . ')', "De: '$valorAntigo' | Para: '" . $this->formatarParaLog($valorFinal) . "'");
                            $mensagem = 'Valor da sessão alterado com sucesso!';
                            $tipoMensagem = 'success';
                        } else {
                            $mensagem = 'Erro: Informe o novo valor para a sessão.';
                            $tipoMensagem = 'danger';
                        }
                    }
                    break;

                case 'remover':
                    session_unset();
                    session_destroy();
                    $_SESSION = [];
                    $this->registrarLog('Sessão Removida', 'N/A');
                    $mensagem = 'Sessão removida e destruída com sucesso!';
                    $tipoMensagem = 'success';
                    break;
            }
        }

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

    //Converte a entrada do usuário na estrutura desejada (String, Array ou Objeto)
    private function prepararValor(string $entrada, string $tipo) {
        if ($tipo === 'array') {
            //Separa valores por vírgula e transforma em um Vetor (Array)
            return array_map('trim', explode(',', $entrada));
        } elseif ($tipo === 'objeto') {
            //Cria um Objeto stdClass no PHP
            $obj = new stdClass();
            $obj->titulo = $entrada;
            $obj->tipo = "Objeto PHP (stdClass)";
            $obj->criado_em = date('d/m/Y H:i:s');
            return $obj;
        }
        return $entrada; //String normal
    }

    private function formatarParaLog($valor): string {
        if (is_array($valor)) {
            return "Array: [" . implode(', ', $valor) . "]";
        } elseif (is_object($valor)) {
            return "Objeto: " . json_encode($valor, JSON_UNESCAPED_UNICODE);
        }
        return (string) $valor;
    }

    private function registrarLog(string $acao, ?string $valor) {
        $log = new SessaoLog();
        $log->setAcao($acao);
        $log->setValor($valor);
        $this->logDao->insert($log);
    }
}