<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../model/Aluno.php");
require_once(__DIR__ . "/../../model/Curso.php");
require_once(__DIR__ . "/../../controller/AlunoController.php");
require_once(__DIR__ . "/../../service/AlunoService.php");

$msgErro = "";
$aluno = null;

if(isset($_POST['nome'])) {
    //captura os dados do formulário
    $nome = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $idade = is_numeric($_POST['idade']) ? (int)$_POST['idade'] : null;
    $estrang = trim($_POST['estrangeiro']) ? trim($_POST['estrangeiro']) : null;
    $idCurso = is_numeric($_POST['curso']) ? (int)$_POST['curso'] : null;

    //cria um objeto aluno
    $aluno = new Aluno();
    $aluno->setNome($nome);
    $aluno->setIdade($idade);
    $aluno->setEstrangeiro($estrang);

    $curso = new Curso();
    $curso->setId($idCurso);
    $aluno->setCurso($curso);

    print_r($aluno);
    //valida os dados do formulário
    

    //persiste o obejto
    $alunoController = new AlunoController();
    $erros = $alunoController->inserir($aluno);

    if (empty($erros)) {
        echo "<p>Aluno inserido com sucesso!</p>";
    } else {
        echo "<p>Ocorreram erros ao inserir o aluno:</p>";
        echo "<ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul>";
    }
}

require_once(__DIR__ . "/form.php");
?>