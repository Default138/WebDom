<?php
require_once(__DIR__ . "/../controller/DisciplinaController.php");

header('Content-Type: application/json; charset=utf-8');

//1 - Entrada - ID do Curso
$idCurso = isset($_GET['id_curso']) ? (int) $_GET['id_curso'] : 0;

//2 - Saída - Lista de Disciplinas em JSON
$disciplinaController = new DisciplinaController();
$disciplinas = $disciplinaController->listarPorCurso($idCurso);

$lista = [];
foreach ($disciplinas as $d) {
    $lista[] = ["id" => $d->getId(), "texto" => (string) $d];
}

echo json_encode($lista);