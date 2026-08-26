<?php
// Este formulário é incluído por inserir.php
// Espera as variáveis: $tarefa (opcional), $prioridades, $temas, $msgErro
if (!isset($tarefa)) $tarefa = null;
if (!isset($msgErro)) $msgErro = "";
?>

<div class="container mt-4" style="max-width: 700px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title mb-4"><?= $tarefa ? '✏️ Editar' : '➕ Inserir' ?> Tarefa</h3>

            <?php if ($msgErro): ?>
                <div class="alert alert-danger">
                    <?= $msgErro ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo"
                           placeholder="Informe o título"
                           value="<?= $tarefa ? htmlspecialchars($tarefa->getTitulo()) : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3"
                              placeholder="Descreva a atividade"><?= $tarefa ? htmlspecialchars($tarefa->getDescricao()) : '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="data_entrega" class="form-label">Data de Entrega</label>
                    <input type="date" class="form-control" id="data_entrega" name="data_entrega"
                           value="<?= $tarefa ? $tarefa->getDataEntrega() : '' ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="prioridade_id" class="form-label">Prioridade</label>
                        <select class="form-select" id="prioridade_id" name="prioridade_id" required>
                            <option value="">Selecione</option>
                            <?php foreach($prioridades as $p): ?>
                                <option value="<?= $p->getId() ?>"
                                    <?= ($tarefa && $tarefa->getPrioridade() && $p->getId() == $tarefa->getPrioridade()->getId()) ? 'selected' : '' ?>>
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
                                <option value="<?= $t->getId() ?>"
                                    <?= ($tarefa && $tarefa->getTema() && $t->getId() == $tarefa->getTema()->getId()) ? 'selected' : '' ?>>
                                    <?= $t->getNome() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <?= $tarefa ? 'Atualizar' : 'Gravar' ?>
                    </button>
                    <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
