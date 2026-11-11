<?php

//exibir erros do PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../controller/DisciplinaController.php";

//1 - Entrada - ID do Curso
$idCurso = 1;
if (isset($_GET['idCurso'])) {
    $idCurso = $_GET['idCurso'];
}

//2 - Saida - Lista de Disciplinas
$disciplinaController = new DisciplinaController();
$listaDisciplinas = $disciplinaController->listarPorCurso($idCurso);

print_r($listaDisciplinas);