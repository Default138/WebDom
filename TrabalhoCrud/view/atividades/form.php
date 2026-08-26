<?php
// Este formulário é incluído por inserir.php
// Espera as variáveis: $tarefa (opcional), $prioridades, $temas, $msgErro
if (!isset($tarefa)) $tarefa = null;
if (!isset($msgErro)) $msgErro = "";
?>

<h3><?= $tarefa ? 'Editar' : 'Inserir' ?> Tarefa</h3>

<?php if ($msgErro): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">
        <?= $msgErro ?>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" 
               placeholder="Informe o título" 
               value="<?= $tarefa ? htmlspecialchars($tarefa->getTitulo()) : '' ?>">
    </div>
    <div>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="3" placeholder="Descreva a atividade"><?= $tarefa ? htmlspecialchars($tarefa->getDescricao()) : '' ?></textarea>
    </div>
    <div>
        <label for="data_entrega">Data de Entrega:</label>
        <input type="date" id="data_entrega" name="data_entrega" 
               value="<?= $tarefa ? $tarefa->getDataEntrega() : '' ?>">
    </div>
    <div>
        <label for="prioridade_id">Prioridade:</label>
        <select id="prioridade_id" name="prioridade_id">
            <option value="">Selecione</option>
            <?php foreach($prioridades as $p): ?>
                <option value="<?= $p->getId() ?>" 
                    <?= ($tarefa && $tarefa->getPrioridade() && $p->getId() == $tarefa->getPrioridade()->getId()) ? 'selected' : '' ?>>
                    <?= $p->getNome() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="tema_id">Tema:</label>
        <select id="tema_id" name="tema_id">
            <option value="">Selecione</option>
            <?php foreach($temas as $t): ?>
                <option value="<?= $t->getId() ?>" 
                    <?= ($tarefa && $tarefa->getTema() && $t->getId() == $tarefa->getTema()->getId()) ? 'selected' : '' ?>>
                    <?= $t->getNome() ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <button type="submit"><?= $tarefa ? 'Atualizar' : 'Gravar' ?></button>
        <a href="listar.php">Cancelar</a>
    </div>
</form>
