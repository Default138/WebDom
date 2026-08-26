<?php

//pagina para editar um aluno

require_once(__DIR__ . "/../../controller/AlunoController.php");
require_once(__DIR__ . "/../../model/Aluno.php");

//recebe id do aluno a ser editado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>ID do aluno não informado ou inválido.</p>";
    exit;
} 

$id = (int)$_GET['id'];
$controller = new AlunoController();

$aluno = $controller->buscarPorId($id);

if (!$aluno) {
    echo "<p>Aluno não encontrado.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Atualizar dados do aluno
    $aluno->setNome($_POST['nome'] ?? '');
    $aluno->setIdade($_POST['idade'] ?? '');
    $aluno->setEstrangeiro($_POST['estrangeiro'] ?? '');
    
    //Criar objeto Curso
    $curso = new Curso();
    $curso->setId($_POST['id_curso'] ?? '');
    $aluno->setCurso($curso);
    
    $erros = $controller->atualizar($aluno);
    
    if (empty($erros)) {
        //Redireciona para a listagem
        header("Location: listar.php");
        exit;
    }
}

//Inclui o cabeçalho da página
require_once(__DIR__ . "/../include/header.php");
?>

<h3>Editar aluno</h3>

<?php if (!empty($erros)): ?>
    <div style="color: red;">
        <?php foreach($erros as $erro): ?>
            <p><?= $erro ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- EASTER EGG (PHP): Exibe ao carregar caso o aluno já tenha esse nome -->
<?php if (strtolower($aluno->getNome()) === 'numsei'): ?>
    <div id="easter-egg-php" style="text-align: center; margin: 15px 0;">
        <img src="../../img/eggAle.jpg" alt="Easter Egg" style="max-width: 250px; border-radius: 8px;">
        <p style="font-weight: bold; color: #ff4500;">🔥 Achouuu 🔥</p>
    </div>
<?php endif; ?>

<form method="POST" action="editar.php?id=<?= $id ?>">
    <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($aluno->getNome()) ?>" required>
    </div>
    
    <div>
        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" value="<?= $aluno->getIdade() ?>" required>
    </div>
    
    <div>
        <label for="selEstrang">Estrangeiro: </label>
        <select name="estrangeiro" id="selEstrang">
            <option value="">----Selecione-----</option>
            <option value="S" <?= $aluno && $aluno->getEstrangeiro() == 'S' ? 'selected' : '' ?>>Sim</option>
            <option value="N" <?= $aluno && $aluno->getEstrangeiro() == 'N' ? 'selected' : '' ?>>Não</option>
        </select>
    </div>
    
    <div>
        <label for="id_curso">Curso:</label>
        <select id="id_curso" name="id_curso" required>
            <option value="">Selecione um curso</option>
            <?php
            //Buscar cursos para o select
            require_once(__DIR__ . "/../../controller/CursoController.php");
            $cursoController = new CursoController();
            $cursos = $cursoController->listar();
            
            foreach($cursos as $curso):
                $selected = ($curso->getId() == $aluno->getCurso()->getId()) ? 'selected' : '';
            ?>
                <option value="<?= $curso->getId() ?>" <?= $selected ?>>
                    <?= $curso->getNome() ?> - <?= $curso->getTurno() ?>
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
//Inclui o rodapé da página
require_once(__DIR__ . "/../include/footer.php");
?>