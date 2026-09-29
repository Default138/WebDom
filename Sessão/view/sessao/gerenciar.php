<?php
require_once(__DIR__ . "/../../controller/SessaoController.php");

$controller = new SessaoController();
$dados = $controller->processar();

// Inclui o cabeçalho padrão
require_once(__DIR__ . "/../include/header.php");
?>

<div class="container mt-4">
    <div class="row">
        <!-- Coluna da Esquerda: Ações -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h3 class="card-title mb-4">⚙️ Gerenciar Sessão</h3>

                    <?php if (!empty($dados['mensagem'])): ?>
                        <div class="alert alert-<?= $dados['tipoMensagem'] ?> alert-dismissible fade show" role="alert">
                            <?= htmlspecialchars($dados['mensagem']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- a) Criar Valor -->
                    <form method="POST" action="" class="mb-3">
                        <input type="hidden" name="acao" value="criar">
                        <div class="input-group">
                            <input type="text" class="form-control" name="valor" placeholder="Valor (texto, número...)" required>
                            <button class="btn btn-success" type="submit">Criar</button>
                        </div>
                    </form>

                    <!-- b) Alterar Valor -->
                    <form method="POST" action="" class="mb-3">
                        <input type="hidden" name="acao" value="alterar">
                        <div class="input-group">
                            <input type="text" class="form-control" name="valor" placeholder="Novo valor" required>
                            <button class="btn btn-warning" type="submit">Alterar</button>
                        </div>
                    </form>

                    <!-- c) Remover Sessão -->
                    <form method="POST" action="">
                        <input type="hidden" name="acao" value="remover">
                        <button class="btn btn-danger w-100" type="submit">Remover Sessão</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Coluna da Direita: Status e Logs -->
        <div class="col-md-6 mb-4">
            <!-- d) Status da Sessão -->
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h4 class="card-title">Status Atual</h4>
                    <?php if ($dados['sessaoExiste']): ?>
                        <div class="alert alert-success m-0">
                            <strong>Sessão Ativa!</strong><br>
                            Valor: <?= htmlspecialchars($dados['valorSessao']) ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger m-0">
                            <strong>Sessão não existe!</strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Logs do Banco de Dados -->
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-clock-history"></i> Últimos Registros
                </div>
                <ul class="list-group list-group-flush" style="max-height: 200px; overflow-y: auto;">
                    <?php if (empty($dados['logs'])): ?>
                        <li class="list-group-item text-muted text-center py-3">Nenhum log registrado.</li>
                    <?php else: ?>
                        <?php foreach ($dados['logs'] as $log): ?>
                            <li class="list-group-item" style="font-size: 0.9em;">
                                <div class="d-flex w-100 justify-content-between">
                                    <strong class="text-primary"><?= htmlspecialchars($log->getAcao()) ?></strong>
                                    <small class="text-muted"><?= date('d/m/Y H:i:s', strtotime($log->getCriadoEm())) ?></small>
                                </div>
                                <span><?= htmlspecialchars($log->getValor()) ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
// Inclui o rodapé padrão
require_once(__DIR__ . "/../include/footer.php");
?>