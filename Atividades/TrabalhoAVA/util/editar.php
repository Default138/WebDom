<?php

require_once("Conexao.php");

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die('ID inexistente');
}

$conexao = Conexao::getConexao();
$sql = "SELECT * FROM Carro WHERE id = :id";
$stm = $conexao->prepare($sql);
$stm->bindValue(':id', $id);
$stm->execute();
$carro = $stm->fetch();

if (!$carro) {
    die('Carro não encontrado');
}

if (isset($_POST['marca'], $_POST['modelo'], $_POST['ano'], $_POST['cor'], $_POST['km'])) {
    try {
        $sql = "UPDATE Carro SET Marca = :marca, Modelo = :modelo, Ano = :ano, Cor = :cor, Km = :km WHERE id = :id";
        $stm = $conexao->prepare($sql);
        $stm->bindValue(':marca', $_POST['marca']);
        $stm->bindValue(':modelo', $_POST['modelo']);
        $stm->bindValue(':ano', $_POST['ano']);
        $stm->bindValue(':cor', $_POST['cor']);
        $stm->bindValue(':km', $_POST['km']);
        $stm->bindValue(':id', $id);
        $stm->execute();
    } catch (Exception $e) {
        die('Erro ao atualizar carro: ' . $e->getMessage());
    }

    header("Location: ../carro.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Editar Carro</h1>

<form method="post">
    <label for="marca">Marca:</label><br>
    <select id="marca" name="marca">
        <option value="">Selecione a marca</option>
        <option value="F"  <?= $carro['Marca'] == 'F'  ? 'selected' : '' ?>>Fiat</option>
        <option value="V"  <?= $carro['Marca'] == 'V'  ? 'selected' : '' ?>>Volkswagen</option>
        <option value="C"  <?= $carro['Marca'] == 'C'  ? 'selected' : '' ?>>Chevrolet</option>
        <option value="Fo" <?= $carro['Marca'] == 'Fo' ? 'selected' : '' ?>>Ford</option>
        <option value="R"  <?= $carro['Marca'] == 'R'  ? 'selected' : '' ?>>Renault</option>
        <option value="H"  <?= $carro['Marca'] == 'H'  ? 'selected' : '' ?>>Honda</option>
        <option value="T"  <?= $carro['Marca'] == 'T'  ? 'selected' : '' ?>>Toyota</option>
        <option value="O"  <?= $carro['Marca'] == 'O'  ? 'selected' : '' ?>>Outro</option>
    </select><br><br>

    <label for="modelo">Modelo:</label><br>
    <input type="text" id="modelo" name="modelo" value="<?= $carro['Modelo'] ?>"><br><br>

    <label for="ano">Ano:</label><br>
    <input type="number" id="ano" name="ano" value="<?= $carro['Ano'] ?>"><br><br>

    <label for="cor">Cor:</label><br>
    <select id="cor" name="cor">
        <option value="">Selecione a cor</option>
        <option value="B"  <?= $carro['Cor'] == 'B'  ? 'selected' : '' ?>>Branca</option>
        <option value="P"  <?= $carro['Cor'] == 'P'  ? 'selected' : '' ?>>Preta</option>
        <option value="Pr" <?= $carro['Cor'] == 'Pr' ? 'selected' : '' ?>>Prata</option>
        <option value="V"  <?= $carro['Cor'] == 'V'  ? 'selected' : '' ?>>Vermelha</option>
        <option value="A"  <?= $carro['Cor'] == 'A'  ? 'selected' : '' ?>>Azul</option>
        <option value="C"  <?= $carro['Cor'] == 'C'  ? 'selected' : '' ?>>Cinza</option>
        <option value="O"  <?= $carro['Cor'] == 'O'  ? 'selected' : '' ?>>Outra</option>
    </select><br><br>

    <label for="km">Quilometragem:</label><br>
    <input type="number" id="km" name="km" value="<?= $carro['Km'] ?>"><br><br>

    <button type="submit">Atualizar</button>
</form>

</body>
</html>
