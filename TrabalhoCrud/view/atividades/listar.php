<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../controller/TarefaController.php");

$tarefaCont = new TarefaController();
$tarefas = $tarefaCont->listar();

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">📋 Listagem de Atividades</h3>
        <a href="inserir.php" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Inserir Nova Atividade
        </a>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_GET['msg']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['erro'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_GET['erro']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Data Entrega</th>
                    <th>Prioridade</th>
                    <th>Tema</th>
                    <th>Criado em</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tarefas)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Nenhuma atividade cadastrada.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach($tarefas as $t): ?>
                    <tr>
                        <td><?= $t->getId() ?></td>
                        <td><?= htmlspecialchars($t->getTitulo()) ?></td>
                        <td><?= htmlspecialchars($t->getDescricao()) ?></td>
                        <td><?= date('d/m/Y', strtotime($t->getDataEntrega())) ?></td>
                        <td><span class="badge bg-warning text-dark"><?= $t->getPrioridade() ?></span></td>
                        <td><span class="badge bg-info text-dark"><?= $t->getTema() ?></span></td>
                        <td><?= date('d/m/Y H:i', strtotime($t->getCriadoEm())) ?></td>
                        <td class="text-center">
                            <a href="editar.php?id=<?= $t->getId() ?>" class="btn btn-sm btn-primary" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="excluir.php?id=<?= $t->getId() ?>"
                               class="btn btn-sm btn-danger"
                               title="Excluir"
                               onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
