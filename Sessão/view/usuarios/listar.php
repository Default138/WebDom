<?php
require_once(__DIR__ . "/../../controller/UsuarioController.php");

$controller = new UsuarioController();
$erros = $controller->cadastrar();
$usuarios = $controller->listar();

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container mt-4 mb-5">
    <div class="row">
        <!-- Coluna da Esquerda: Formulário de Cadastro -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">👤 Cadastrar Usuário</h4>

                    <?php if (!empty($erros)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong class="d-block mb-1"><i class="bi bi-exclamation-triangle-fill"></i> Erro ao cadastrar:</strong>
                            <ul class="mb-0 ps-3">
                                <?php foreach ($erros as $erro): ?>
                                    <li><?= htmlspecialchars($erro ?? '') ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="" novalidate>
                        <input type="hidden" name="acao" value="cadastrar">

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: João Silva" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="joao@email.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="••••••••">
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-person-plus-fill"></i> Cadastrar Usuário
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Coluna da Direita: Tabela de Usuários -->
        <div class="col-md-7 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">📋 Usuários do Sistema</h4>

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
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th class="text-center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($usuarios)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">Nenhum usuário cadastrado.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($usuarios as $u): ?>
                                        <tr>
                                            <td><?= $u->getId() ?></td>
                                            <td>
                                                <strong><?= htmlspecialchars($u->getNome() ?? '') ?></strong>
                                                <?php if ($u->getEmail() === 'admin@email.com'): ?>
                                                    <span class="badge bg-warning text-dark ms-1">Admin</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($u->getEmail() ?? '') ?></td>
                                            <td class="text-center">
                                                <?php if ($u->getId() === ($_SESSION['usuario_logado']['id'] ?? 0)): ?>
                                                    <span class="badge bg-secondary">Sua Conta</span>
                                                <?php else: ?>
                                                    <a href="excluir.php?id=<?= $u->getId() ?>" 
                                                       class="btn btn-sm btn-outline-danger"
                                                       onclick="return confirm('Tem certeza que deseja excluir o usuário <?= htmlspecialchars($u->getNome() ?? '') ?>?')">
                                                        <i class="bi bi-trash"></i> Excluir
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>