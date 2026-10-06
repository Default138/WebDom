<?php
require_once(__DIR__ . "/../../controller/AuthController.php");

$authController = new AuthController();
$erros = $authController->login();

// Se o usuário já estiver logado, redireciona para a home
if (isset($_SESSION['usuario_logado'])) {
    header("Location: " . URL_SISTEMA . "index.php");
    exit;
}

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container mt-5" style="max-width: 450px;">
    <div class="card shadow">
        <div class="card-body p-4">
            <h3 class="card-title text-center mb-4">🔐 Login do Sistema</h3>

            <?php if (isset($_GET['msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show"><?= htmlspecialchars($_GET['msg']) ?></div>
            <?php endif; ?>

            <?php if (isset($_GET['erro'])): ?>
                <div class="alert alert-danger alert-dismissible fade show"><?= htmlspecialchars($_GET['erro']) ?></div>
            <?php endif; ?>

            <?php if (!empty($erros)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        <?php foreach ($erros as $erro): ?>
                            <li><?= htmlspecialchars($erro ?? '') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="admin@email.com" required>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">Entrar</button>
            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>