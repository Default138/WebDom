<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
require_once("../../util/Connection.php");
$conn = new Connection();
print_r($conn->getConnection());
*/

require_once(__DIR__ . "/../../controller/AlunoController.php");

$AlunoController = new AlunoController();
$alunos = $AlunoController->listarAlunos();
//print_r($alunos);

require_once(__DIR__ . "/../include/header.php");
?>

  <body>
    <div class="container mt-5">
      <h1 class="mb-4">Lista de Alunos</h1>
      
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Estrangeiro</th>
            <th>Curso ID</th>
            <th>Curso Nome</th>
            <th>Curso Turno</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($alunos as $aluno): ?>
            <tr>
              <td><?php echo $aluno->getId(); ?></td>
              <td><?php echo $aluno->getNome(); ?></td>
              <td><?php echo $aluno->getIdade(); ?></td>
              <td><?php echo $aluno->getEstrangeiro(); ?></td>
              <td><?php echo $aluno->getCurso()->getId(); ?></td>
              <td><?php echo $aluno->getCurso()->getNome(); ?></td>
              <td><?php echo $aluno->getCurso()->getTurnoDesc(); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>