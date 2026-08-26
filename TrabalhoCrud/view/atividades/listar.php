<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../controller/TarefaController.php");

$tarefaCont = new TarefaController();
$tarefas = $tarefaCont->listar();

require_once(__DIR__ . "/../include/header.php");
?>

<h3>📋 Listagem de Atividades</h3>

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

<a href="inserir.php">➕ Inserir Nova Atividade</a>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Descrição</th>
        <th>Data Entrega</th>
        <th>Prioridade</th>
        <th>Tema</th>
        <th>Criado em</th>
        <th>Ações</th>
    </tr>

    <?php foreach($tarefas as $t): ?>
        <tr>
            <td><?= $t->getId() ?></td>
            <td><?= htmlspecialchars($t->getTitulo()) ?></td>
            <td><?= htmlspecialchars($t->getDescricao()) ?></td>
            <td><?= date('d/m/Y', strtotime($t->getDataEntrega())) ?></td>
            <td><?= $t->getPrioridade() ?></td>
            <td><?= $t->getTema() ?></td>
            <td><?= date('d/m/Y H:i', strtotime($t->getCriadoEm())) ?></td>
            <td>
                <a href="editar.php?id=<?= $t->getId() ?>">
                    <img src="../../img/btn_editar.png" alt="Editar">
                </a>
                <a href="excluir.php?id=<?= $t->getId() ?>" 
                   onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                    <img src="../../img/btn_excluir.png" alt="Excluir">
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>