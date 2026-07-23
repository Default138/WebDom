<?php

require_once 'Conexao.php';

//identificar o livro a ser excluido
$id = $_GET['id'] ?? null;

//validar o ID
if (!$id || !is_numeric($id)) {
    die('ID inexistente');
}

$livro = null;

$conexao = Conexao::getConexao();
$sql = "SELECT * FROM livros WHERE id = :id";
$stm = $conexao->prepare($sql);
$stm->bindValue(':id', $id);
$stm->execute();
$livro = $stm->fetch();

if (isset($_POST['titulo'], $_POST['genero'], $_POST['qtd_paginas'], $_POST['autor'])) {
    try {
        $conexao = Conexao::getConexao();
        $sql = "UPDATE livros SET titulo = :titulo, genero = :genero, qtd_paginas = :qtd_paginas, autor = :autor WHERE id = :id";
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':titulo', $_POST['titulo']);
        $stm->bindValue(':genero', $_POST['genero']);
        $stm->bindValue(':qtd_paginas', $_POST['qtd_paginas']);
        $stm->bindValue(':autor', $_POST['autor']);
        $stm->bindValue(':id', $id);
        $stm->execute();
    } catch (Exception $e) {
        die('Erro ao atualizar livro: ' . $e->getMessage());
    }

    header("Location: ../livros.php");
    exit;

    //voltar para a pagina de livros
    header("Location: ../livros.php");
    exit;
} else {

?>

    <form method="post" action="editar.php?id=<?= $id ?>">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="<?= $livro['titulo'] ?>" required>

        <label for="genero">Gênero:</label>
        <select name="genero" id="genero" required>
            <option value="<?= $livro['genero'] ?>">Selecione</option>
            <option value="F">Ficção</option>
            <option value="R">Romance</option>
            <option value="D">Drama</option>
            <option value="O">Outro</option>
        </select><br>

        <label for="qtd_paginas">Quantidade de páginas:</label>
        <input type="number" name="qtd_paginas" id="qtd_paginas" value="<?= $livro['qtd_paginas'] ?>" required>

        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" value="<?= $livro['autor'] ?>" required><br>

        <button type="submit">Salvar</button>
    </form>
<?php } ?>