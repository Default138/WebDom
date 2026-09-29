<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../controller/TarefaController.php");

$tarefaCont = new TarefaController();
$tarefas = $tarefaCont->listar();

// Função para mapear o nome do Tema para o arquivo de imagem correto na pasta img
function obterImagemTema($nomeTema) {
    $nome = mb_strtolower(trim($nomeTema), 'UTF-8');

    $mapa = [
        'banco de dados' => 'banco_dados.jpeg',
        'biologia'       => 'biologia.jpeg',
        'física'         => 'fisica.jpeg',
        'fisica'         => 'fisica.jpeg',
        'geografia'      => 'geografia.jpg',
        'história'       => 'historia.jpeg',
        'historia'       => 'historia.jpeg',
        'inglês'         => 'ingles.jpeg',
        'ingles'         => 'ingles.jpeg',
        'matemática'     => 'matematica.jpeg',
        'matematica'     => 'matematica.jpeg',
        'português'      => 'portugues.jpeg',
        'portugues'      => 'portugues.jpeg',
        'programação'    => 'programação.jpeg',
        'programacao'    => 'programação.jpeg',
        'química'        => 'quimica.jpeg',
        'quimica'        => 'quimica.jpeg'
    ];

    return $mapa[$nome] ?? null;
}

require_once(__DIR__ . "/../include/header.php");
?>

<div class="container mt-4 mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
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

    <?php if (empty($tarefas)): ?>
        <div class="alert alert-info text-center py-4">
            <i class="bi bi-info-circle fs-4 d-block mb-2"></i>
            Nenhuma atividade cadastrada no momento.
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach($tarefas as $t): ?>
                <?php 
                    $temaNome = (string)$t->getTema();
                    $nomeImagem = obterImagemTema($temaNome);
                    $caminhoImagem = $nomeImagem ? "../../img/" . $nomeImagem : null;
                    $caminhoFisico = $nomeImagem ? __DIR__ . "/../../img/" . $nomeImagem : null;
                ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        
                        <!-- Imagem do Tema ajustada para exibir 100% sem cortes -->
                        <?php if ($caminhoImagem && file_exists($caminhoFisico)): ?>
                            <div class="bg-dark text-center" style="height: 200px;">
                                <img src="<?= $caminhoImagem ?>" 
                                     class="card-img-top h-100" 
                                     alt="<?= htmlspecialchars($temaNome) ?>" 
                                     style="object-fit: contain; width: 100%;">
                            </div>
                        <?php else: ?>
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center card-img-top" style="height: 200px;">
                                <i class="bi bi-journal-bookmark fs-1"></i>
                            </div>
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-info text-dark"><?= htmlspecialchars($temaNome) ?></span>
                                <span class="badge bg-warning text-dark"><?= htmlspecialchars((string)$t->getPrioridade()) ?></span>
                            </div>

                            <h5 class="card-title fw-bold text-dark mt-1 mb-2"><?= htmlspecialchars($t->getTitulo()) ?></h5>
                            
                            <p class="card-text text-secondary flex-grow-1" style="font-size: 0.95rem;">
                                <?= nl2br(htmlspecialchars($t->getDescricao() ?? 'Sem descrição informada.')) ?>
                            </p>

                            <hr class="my-2">

                            <div class="small text-muted mb-3">
                                <div><i class="bi bi-calendar-event me-1"></i> <strong>Data Entrega:</strong> <?= date('d/m/Y', strtotime($t->getDataEntrega())) ?></div>
                                <div><i class="bi bi-clock me-1"></i> <strong>Criado em:</strong> <?= date('d/m/Y H:i', strtotime($t->getCriadoEm())) ?></div>
                            </div>

                            <!-- Botões de Ação -->
                            <div class="d-flex gap-2 mt-auto">
                                <a href="editar.php?id=<?= $t->getId() ?>" class="btn btn-outline-primary btn-sm w-50">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <a href="excluir.php?id=<?= $t->getId() ?>"
                                   class="btn btn-outline-danger btn-sm w-50"
                                   onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                                    <i class="bi bi-trash"></i> Excluir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>