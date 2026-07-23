<?php

//exibi erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();
//print_r($conexao);

$msgError = "";

$titulo = "";
$genero = "";
$qtd_paginas = "";
$autor = "";

//Salva Livros
if (isset($_POST['titulo'])) {
    //Recebe os dados
    $titulo = trim($_POST['titulo']) ? trim($_POST['titulo']) : null;
    $genero = trim($_POST['genero']) ? trim($_POST['genero']) : null;
    $qtd_paginas = trim($_POST['qtd_paginas']) ? trim($_POST['qtd_paginas']) : null;
    $autor = trim($_POST['autor']) ? trim($_POST['autor']) : null;

    //Valida os dados
    $msgs = array();
    if (!$titulo){
        array_push($msgs, "O título é obrigatório.");
    } else if (strlen($titulo) < 3 || strlen($titulo) > 50) {
        array_push($msgs, "O título deve conter pelo menos 3 caracteres e no máximo 50.");
    }

    if (!$genero){
        array_push($msgs, "O gênero é obrigatório.");
    }

    if (!$qtd_paginas){
        array_push($msgs, "A quantidade de páginas é obrigatória.");
    } else if (!is_numeric($qtd_paginas) || $qtd_paginas <= 0) {
        array_push($msgs, "A quantidade de páginas deve ser um número positivo.");
    }

    if (!$autor){
        array_push($msgs, "O autor é obrigatório.");
    }

    if (empty($msgs)) {
        //Salva no banco
        $sql = "INSERT INTO livros (titulo, genero, qtd_paginas, autor)
                VALUES (?, ?, ?, ?)";
        $stm = $conexao->prepare($sql);
        $stm->execute([$titulo, $genero, $qtd_paginas, $autor]);

        //Volta pra lista
        header("location: livros.php");
    } else {
        //Exibe os erros
        $msgError = implode("<br>", $msgs);
    }
}

/*
if (isset($_POST['titulo'], $_POST['genero'], $_POST['qtd_paginas'], $_POST['autor'])) {
    $sql = "INSERT INTO livros (titulo, genero, qtd_paginas, autor) VALUES (:titulo, :genero, :qtd_paginas, :autor)";
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':titulo', $_POST['titulo']);
    $stm->bindValue(':genero', $_POST['genero']);
    $stm->bindValue(':qtd_paginas', $_POST['qtd_paginas']);
    $stm->bindValue(':autor', $_POST['autor']);
    $stm->execute();

    header("Location: livros.php");
    exit;
}
*/

$sql = "SELECT * FROM livros";
$stm = $conexao->prepare($sql);
$stm->execute();
$livros = $stm->fetchAll();

//echo '<pre>' . print_r($livros, true) . '</pre>';

//aleatoriedade de estilos
$estilos = ['util/funcional.css', 'util/viado.css'];
$estilo_escolhido = $estilos[array_rand($estilos)];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de livros</title>

    <link rel="stylesheet" href="<?= $estilo_escolhido ?>">

</head>

<body>

    <h1>Cadastro de livros</h1>

    <!-- Listagem dos livros -->
    <h3>Listagem</h3>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Genero</th>
            <th>Paginas</th>
            <th>Opção</th>
            <th>Autor</th>
        </tr>

        <?php foreach ($livros as $livro): ?>
            <tr>
                <td><?= $livro['id'] ?></td>
                <td><?= $livro['titulo'] ?></td>
                <td><?php
                    if ($livro['genero'] == 'F') {
                        echo 'Ficção';
                    } else if ($livro['genero'] == 'R') {
                        echo 'Romance';
                    } else if ($livro['genero'] == 'D') {
                        echo 'Drama';
                    } else {
                        echo 'Outro';
                    }
                    ?>
                </td>
                <td><?= $livro['qtd_paginas'] ?></td>
                <td>
                    <a onclick="if(!confirm('Excluir?')) return false;" href="util/excluir.php?id=<?= $livro['id'] ?>">Excluir</a>
                    <a href="util/editar.php?id=<?= $livro['id'] ?>">Editar</a>
                </td>
                <td><?= $livro['autor'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Formulário</h3>

        <div style="color: red;"><?= $msgError ?></div>

    <form method="post" onsubmit="return validarFormulario()">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="<?= $titulo ?>"><br>

        <label for="genero">Gênero:</label>
        <select name="genero" id="genero">
            <option value="">Selecione</option>
            <option value="F" <?= $genero == 'F' ? 'selected' : '' ?>>Ficção</option>
            <option value="R" <?= $genero == 'R' ? 'selected' : '' ?>>Romance</option>
            <option value="D" <?= $genero == 'D' ? 'selected' : '' ?>>Drama</option>
            <option value="O" <?= $genero == 'O' ? 'selected' : '' ?>>Outro</option>
        </select><br>

        <label for="qtd_paginas">Quantidade de páginas:</label>
        <input type="number" name="qtd_paginas" id="qtd_paginas" value="<?= $qtd_paginas ?>"><br>

        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" value="<?= $autor ?>"><br>

        <button type="submit">Cadastrar</button>
    </form>

    <script src="validacao.js"></script>

</body>

</html>