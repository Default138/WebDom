<?php
require_once(__DIR__ . "/../../controller/TarefaController.php");
require_once(__DIR__ . "/../../model/Tarefa.php");
require_once(__DIR__ . "/../../model/Prioridade.php");
require_once(__DIR__ . "/../../model/Tema.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>ID da tarefa não informado ou inválido.</div></div>";
    exit;
}

$id = (int)$_GET['id'];
$controller = new TarefaController();
$tarefa = $controller->buscarPorId($id);

if (!$tarefa) {
    echo "<div class='container mt-4'><div class='alert alert-warning'>Tarefa não encontrada.</div></div>";
    exit;
}

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarefa->setTitulo($_POST['titulo'] ?? '');
    $tarefa->setDescricao($_POST['descricao'] ?? '');
    $tarefa->setDataEntrega($_POST['data_entrega'] ?? '');

    $prioridade = new Prioridade();
    $prioridade->setId($_POST['prioridade_id'] ?? null);
    $tarefa->setPrioridade($prioridade);

    $tema = new Tema();
    $tema->setId($_POST['tema_id'] ?? null);
    $tarefa->setTema($tema);

    $erros = $controller->atualizar($tarefa);

    if (empty($erros)) {
        header("Location: listar.php?msg=Tarefa atualizada com sucesso!");
        exit;
    }
}

// Buscar prioridades e temas
require_once(__DIR__ . "/../../controller/PrioridadeController.php");
require_once(__DIR__ . "/../../controller/TemaController.php");
$prioridadeCont = new PrioridadeController();
$temaCont = new TemaController();
$prioridades = $prioridadeCont->listar();
$temas = $temaCont->listar();

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container mt-4" style="max-width: 700px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title mb-4">✏️ Editar Tarefa</h3>

            <?php if (!empty($erros)): ?>
                <div class="alert alert-danger">
                    <?php foreach($erros as $erro): ?>
                        <div><?= $erro ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="editar.php?id=<?= $id ?>">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo"
                           value="<?= htmlspecialchars($tarefa->getTitulo()) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3"><?= htmlspecialchars($tarefa->getDescricao()) ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="data_entrega" class="form-label">Data de Entrega</label>
                    <input type="date" class="form-control" id="data_entrega" name="data_entrega"
                           value="<?= $tarefa->getDataEntrega() ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="prioridade_id" class="form-label">Prioridade</label>
                        <select class="form-select" id="prioridade_id" name="prioridade_id" required>
                            <option value="">Selecione</option>
                            <?php foreach($prioridades as $p): ?>
                                <option value="<?= $p->getId() ?>" <?= ($p->getId() == $tarefa->getPrioridade()->getId()) ? 'selected' : '' ?>>
                                    <?= $p->getNome() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tema_id" class="form-label">Tema</label>
                        <select class="form-select" id="tema_id" name="tema_id" required>
                            <option value="">Selecione</option>
                            <?php foreach($temas as $t): ?>
                                <option value="<?= $t->getId() ?>" <?= ($t->getId() == $tarefa->getTema()->getId()) ? 'selected' : '' ?>>
                                    <?= $t->getNome() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
