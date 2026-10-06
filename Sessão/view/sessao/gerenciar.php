<?php
require_once(__DIR__ . "/../../controller/SessaoController.php");

$controller = new SessaoController();
$dados = $controller->processar();

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container mt-4 mb-5">
    <div class="row">
        <!-- Coluna da Esquerda: Formulários -->
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

                    <!-- Formulário de Criar -->
                    <form method="POST" action="" class="p-3 border rounded mb-3 bg-light">
                        <h6 class="fw-bold mb-2 text-success">➕ Criar na Sessão</h6>
                        <input type="hidden" name="acao" value="criar">
                        
                        <div class="mb-2">
                            <input type="text" class="form-control" name="valor" placeholder="Ex: Maçã, Banana, Pera (se for vetor)" required>
                        </div>

                        <div class="d-flex gap-2 mb-2">
                            <select name="tipo_estrutura" class="form-select form-select-sm">
                                <option value="string">Texto / Número (Simples)</option>
                                <option value="array">Vetor / Array (separe por vírgula)</option>
                                <option value="objeto">Objeto (stdClass)</option>
                            </select>
                            <button class="btn btn-success btn-sm px-3" type="submit">Criar</button>
                        </div>
                    </form>

                    <!-- Formulário de Alterar -->
                    <form method="POST" action="" class="p-3 border rounded mb-3 bg-light">
                        <h6 class="fw-bold mb-2 text-warning text-dark">✏️ Alterar Valor da Sessão</h6>
                        <input type="hidden" name="acao" value="alterar">
                        
                        <div class="mb-2">
                            <input type="text" class="form-control" name="valor" placeholder="Novo valor" required>
                        </div>

                        <div class="d-flex gap-2 mb-2">
                            <select name="tipo_estrutura" class="form-select form-select-sm">
                                <option value="string">Texto / Número (Simples)</option>
                                <option value="array">Vetor / Array (separe por vírgula)</option>
                                <option value="objeto">Objeto (stdClass)</option>
                            </select>
                            <button class="btn btn-warning btn-sm px-3" type="submit">Alterar</button>
                        </div>
                    </form>

                    <!-- Remover Sessão -->
                    <form method="POST" action="">
                        <input type="hidden" name="acao" value="remover">
                        <button class="btn btn-danger w-100" type="submit">🗑️ Remover Sessão</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Coluna da Direita: Status da Sessão -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title text-center mb-3">Status Atual da Sessão</h4>
                    
                    <?php if ($dados['sessaoExiste']): ?>
                        <?php $val = $dados['valorSessao']; ?>
                        <div class="alert alert-success m-0">
                            <strong>Sessão Ativa!</strong><br>
                            <hr class="my-2">

                            <!-- Exibição de Acordo com o Tipo Armazenado -->
                            <?php if (is_array($val)): ?>
                                <span class="badge bg-primary mb-2">Estrutura: Vetor (Array)</span>
                                <ul class="mb-0 ps-3 text-start">
                                    <?php foreach ($val as $indice => $item): ?>
                                        <li><strong>[<?= $indice ?>] =></strong> <?= htmlspecialchars($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>

                            <?php elseif (is_object($val)): ?>
                                <span class="badge bg-purple bg-dark mb-2">Estrutura: Objeto (stdClass)</span>
                                <ul class="mb-0 ps-3 text-start">
                                    <li><strong>Propriedade 'titulo':</strong> <?= htmlspecialchars($val->titulo ?? '') ?></li>
                                    <li><strong>Propriedade 'tipo':</strong> <?= htmlspecialchars($val->tipo ?? '') ?></li>
                                    <li><strong>Propriedade 'criado_em':</strong> <?= htmlspecialchars($val->criado_em ?? '') ?></li>
                                </ul>

                            <?php else: ?>
                                <span class="badge bg-secondary mb-2">Estrutura: Texto (String)</span>
                                <div><strong>Valor:</strong> <?= htmlspecialchars((string)$val) ?></div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger text-center m-0">
                            <strong>Sessão não existe!</strong>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Logs de Auditoria -->
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-clock-history"></i> Histórico de Registros no Banco
                </div>
                <ul class="list-group list-group-flush" style="max-height: 220px; overflow-y: auto;">
                    <?php if (empty($dados['logs'])): ?>
                        <li class="list-group-item text-muted text-center py-3">Nenhum log registrado.</li>
                    <?php else: ?>
                        <?php foreach ($dados['logs'] as $log): ?>
                            <li class="list-group-item" style="font-size: 0.85em;">
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
require_once(__DIR__ . "/../include/footer.php");
?>