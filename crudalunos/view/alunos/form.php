<?php

require_once __DIR__ . '/../../controller/AlunoController.php';
require_once __DIR__ . '/../../controller/CursoController.php';

$cursoController = new CursoController();
$cursos = $cursoController->listarCursos();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Alunos</title>
</head>

<body>

    <h3>Listagem de Alunos</h3>

<form>



    <div>
        <label for="selEstrangeiro">Estrangeiro:</label>
        <select name="estrangeiro" id="selEstrangeiro">
            <option value="">---Selecione---</option>
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
    </div>

    <div>
        <label for="selCurso">Curso:</label>
        <select name="curso" id="selCurso">
            <option value="">---Selecione---</option>

            <?php foreach ($cursos as $curso): ?>
                <option value="<?= $curso->getId() ?>"><?= $curso->getNome() ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <button type="submit">Gravar</button>
    </div>

</form>

<a href="index.php">Voltar</a>