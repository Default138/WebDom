<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../model/Tarefa.php");
require_once(__DIR__ . "/../../model/Prioridade.php");
require_once(__DIR__ . "/../../model/Tema.php");
require_once(__DIR__ . "/../../controller/TarefaController.php");
require_once(__DIR__ . "/../../service/TarefaService.php");

$msgErro = "";
$tarefa = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura dados
    $titulo = trim($_POST['titulo']) ?: null;
    $descricao = trim($_POST['descricao']) ?: null;
    $data_entrega = trim($_POST['data_entrega']) ?: null;
    $prioridade_id = is_numeric($_POST['prioridade_id']) ? (int)$_POST['prioridade_id'] : null;
    $tema_id = is_numeric($_POST['tema_id']) ? (int)$_POST['tema_id'] : null;

    // Monta objeto Tarefa
    $tarefa = new Tarefa();
    $tarefa->setTitulo($titulo);
    $tarefa->setDescricao($descricao);
    $tarefa->setDataEntrega($data_entrega);

    $prioridade = new Prioridade();
    $prioridade->setId($prioridade_id);
    $tarefa->setPrioridade($prioridade);

    $tema = new Tema();
    $tema->setId($tema_id);
    $tarefa->setTema($tema);

    $controller = new TarefaController();
    $erros = $controller->inserir($tarefa);

    if (empty($erros)) {
        header("Location: listar.php?msg=Tarefa inserida com sucesso!");
        exit;
    } else {
        $msgErro = implode('<br>', $erros);
    }
}

// Buscar prioridades e temas para os selects
require_once(__DIR__ . "/../../controller/PrioridadeController.php");
require_once(__DIR__ . "/../../controller/TemaController.php");

$prioridadeCont = new PrioridadeController();
$temasCont = new TemaController();
$prioridades = $prioridadeCont->listar();
$temas = $temasCont->listar();

// Inclui o formulário
require_once(__DIR__ . "/form.php");
?>