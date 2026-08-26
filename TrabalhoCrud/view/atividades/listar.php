<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../controller/AlunoController.php");

//Buscar os alunos -> origem: base de dados
$alunoCont = new AlunoController();
$alunos = $alunoCont->listar();
//print_r($alunos);

//Inclui o cabeçalho da página
require_once(__DIR__ . "/../include/header.php");
?>

<h3>Listagem de alunos</h3>

<?php if (isset($_GET['msg'])): ?>
    <div style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 10px;">
        <?= htmlspecialchars($_GET['msg']) ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['erro'])): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
        <?= htmlspecialchars($_GET['erro']) ?>
    </div>
<?php endif; ?>

<a href="inserir.php">Inserir</a>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Idade</th>
        <th>Estrangeiro</th>
        <th>Curso</th>
        <th>Ações</th>
    </tr>

    <?php foreach($alunos as $a): ?>
        <tr>
            <td><?= $a->getId() ?></td>
            <td><?= $a->getNome() ?></td>
            <td><?= $a->getIdade() ?></td>
            <td><?= $a->getEstrangeiroDesc() ?></td>
            <td><?= $a->getCurso() ?></td>
            <td>
                <a href="editar.php?id=<?= $a->getId() ?>">
                    <img src="../../img/btn_editar.png" alt="Editar">
                </a>
                <a href="excluir.php?id=<?= $a->getId() ?>" 
                   onclick="return confirm('Tem certeza que deseja excluir este aluno?')">
                    <img src="../../img/btn_excluir.png" alt="Excluir">
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
//Inclui o rodapé da página
require_once(__DIR__ . "/../include/footer.php");
?>