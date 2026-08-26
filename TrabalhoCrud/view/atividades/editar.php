<?php
require_once(__DIR__ . "/../../controller/TarefaController.php");
require_once(__DIR__ . "/../../model/Tarefa.php");
require_once(__DIR__ . "/../../model/Prioridade.php");
require_once(__DIR__ . "/../../model/Tema.php");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>ID da tarefa não informado ou inválido.</p>";
    exit;
}

$id = (int)$_GET['id'];
$controller = new TarefaController();
$tarefa = $controller->buscarPorId($id);

if (!$tarefa) {
    echo "<p>Tarefa não encontrada.</p>";
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

<h3>✏️ Editar Tarefa</h3>

<?php if (!empty($erros)): ?>
    <div style="color: red;">
        <?php foreach($erros as $erro): ?>
            <p><?= $erro ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" action="editar.php?id=<?= $id ?>">
    <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($tarefa->getTitulo()) ?>" required>
    </div>
    <div>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="3"><?= htmlspecialchars($tarefa->getDescricao()) ?></textarea>
    </div>
    <div>
        <label for="data_entrega">Data de Entrega:</label>
        <input type="date" id="data_entrega" name="data_entrega" value="<?= $tarefa->getDataEntrega() ?>" required>
    </div>
    <div>
        <label for="prioridade_id">Prioridade:</label>
        <select id="prioridade_id" name="prioridade_id" required>
            <option value="">Selecione</option>
            <?php foreach($prioridades as $p): ?>
                <option value="<?= $p->getId() ?>" <?= ($p->getId() == $tarefa->getPrioridade()->getId()) ? 'selected' : '' ?>>
                    <?= $p->getNome() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="tema_id">Tema:</label>
        <select id="tema_id" name="tema_id" required>
            <option value="">Selecione</option>
            <?php foreach($temas as $t): ?>
                <option value="<?= $t->getId() ?>" <?= ($t->getId() == $tarefa->getTema()->getId()) ? 'selected' : '' ?>>
                    <?= $t->getNome() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <button type="submit">Salvar</button>
        <a href="listar.php">Cancelar</a>
    </div>
</form>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>