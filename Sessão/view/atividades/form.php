<?php
if (!isset($tarefa)) $tarefa = null;
if (!isset($erros)) $erros = [];
?>

<div class="container mt-4" style="max-width: 700px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title mb-4"><?= $tarefa && $tarefa->getId() ? '✏️ Editar' : '➕ Inserir' ?> Tarefa</h3>

            <!-- Exibição das mensagens de erro personalizadas do TarefaService -->
            <?php if (!empty($erros)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong class="d-block mb-1"><i class="bi bi-exclamation-triangle-fill"></i> Por favor, corrija os erros abaixo:</strong>
                    <ul class="mb-0 ps-3">
                        <?php foreach ($erros as $erro): ?>
                            <li><?= htmlspecialchars($erro ?? '') ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- 'novalidate' desativa os balões nativos do navegador -->
            <form method="POST" action="" novalidate>
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo"
                           placeholder="Informe o título"
                           value="<?= htmlspecialchars(($tarefa ? $tarefa->getTitulo() : '') ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3"
                              placeholder="Descreva a atividade"><?= htmlspecialchars(($tarefa ? $tarefa->getDescricao() : '') ?? '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="data_entrega" class="form-label">Data de Entrega</label>
                    <input type="date" class="form-control" id="data_entrega" name="data_entrega"
                           min="<?= date('Y-m-d') ?>"
                           value="<?= $tarefa ? $tarefa->getDataEntrega() : '' ?>">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="prioridade_id" class="form-label">Prioridade</label>
                        <select class="form-select" id="prioridade_id" name="prioridade_id">
                            <option value="">Selecione</option>
                            <?php foreach($prioridades as $p): ?>
                                <option value="<?= $p->getId() ?>"
                                    <?= ($tarefa && $tarefa->getPrioridade() && $p->getId() == $tarefa->getPrioridade()->getId()) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($p->getNome() ?? '') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tema_id" class="form-label">Tema</label>
                        <select class="form-select" id="tema_id" name="tema_id">
                            <option value="">Selecione</option>
                            <?php foreach($temas as $t): ?>
                                <option value="<?= $t->getId() ?>"
                                    <?= ($tarefa && $tarefa->getTema() && $t->getId() == $tarefa->getTema()->getId()) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($t->getNome() ?? '') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">
                        <?= $tarefa && $tarefa->getId() ? 'Atualizar' : 'Gravar' ?>
                    </button>
                    <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>