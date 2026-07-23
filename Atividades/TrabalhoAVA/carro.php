<?php

//exibi erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();

$msgError = "";

$marca = "";
$modelo = "";
$ano = "";
$cor = "";
$km = "";

//Salva os Carros
if (isset($_POST['marca'])) {
    $marca = trim($_POST['marca']) ? trim($_POST['marca']) : null;
    $modelo = trim($_POST['modelo']) ? trim($_POST['modelo']) : null;
    $ano = trim($_POST['ano']) ? trim($_POST['ano']) : null;
    $cor = trim($_POST['cor']) ? trim($_POST['cor']) : null;
    $km = trim($_POST['km']) ? trim($_POST['km']) : null;

    $msgs = array();
    if (!$marca) {
        array_push($msgs, "A marca é obrigatória.");
    }
    if (!$modelo) {
        array_push($msgs, "O modelo é obrigatório.");
    }
    if (!$ano) {
        array_push($msgs, "O ano é obrigatório.");
    } else if (!is_numeric($ano) || $ano <= 1885) {
        array_push($msgs, "Não existem carros abaixo de 1885.");
    }
    if (!$cor) {
        array_push($msgs, "A cor é obrigatória.");
    }
    if (!$km) {
        array_push($msgs, "A Quilometragem é obrigatória.");
    } else if (!is_numeric($km) || $km <= 0) {
        array_push($msgs, "A Quilometragem deve ser um número não negativo.");
    }

    if (empty($msgs)) {
        $sql = "INSERT INTO Carro (Marca, Modelo, Ano, Cor, Km) VALUES (?, ?, ?, ?, ?)";
        $stm = $conexao->prepare($sql);
        $stm->execute([$marca, $modelo, $ano, $cor, $km]);

        header("location: carro.php");
        exit;
    } else {
        $msgError = implode("<br>", $msgs);
    }
}

$sql = "SELECT * FROM Carro";
$stm = $conexao->prepare($sql);
$stm->execute();
$carros = $stm->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Carros</title>
    <link rel="stylesheet" href="util/style.css">
</head>

<body>
    <h1>Cadastro de Carros</h1>

    <h3>Listagem dos Carros</h3>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Ano</th>
            <th>Cor</th>
            <th>Km</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($carros as $carro) { ?>
            <tr>
                <td><?= $carro['id'] ?></td>
                <td><?php
                    if ($carro['Marca'] == 'F') echo 'Fiat';
                    else if ($carro['Marca'] == 'V') echo 'Volkswagen';
                    else if ($carro['Marca'] == 'C') echo 'Chevrolet';
                    else if ($carro['Marca'] == 'Fo') echo 'Ford';
                    else if ($carro['Marca'] == 'R') echo 'Renault';
                    else if ($carro['Marca'] == 'H') echo 'Honda';
                    else if ($carro['Marca'] == 'T') echo 'Toyota';
                    else echo 'Outro';
                    ?></td>
                <td><?= $carro['Modelo'] ?></td>
                <td><?= $carro['Ano'] ?></td>
                <td><?php
                    if ($carro['Cor'] == 'B') echo 'Branca';
                    else if ($carro['Cor'] == 'P') echo 'Preta';
                    else if ($carro['Cor'] == 'Pr') echo 'Prata';
                    else if ($carro['Cor'] == 'V') echo 'Vermelha';
                    else if ($carro['Cor'] == 'A') echo 'Azul';
                    else if ($carro['Cor'] == 'C') echo 'Cinza';
                    else echo 'Outra';
                    ?></td>
                <td><?= $carro['Km'] ?></td>
                <td>
                    <a href="util/excluir.php?id=<?= $carro['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este carro?')">Excluir</a>
                    <a href="util/editar.php?id=<?= $carro['id'] ?>">Editar</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h3>Formulário</h3>

    <?php if ($msgError): ?>
        <div style="color: red;"><?= $msgError ?></div>
    <?php endif; ?>

    <form method="post">
        <label for="marca">Marca:</label><br>
        <select id="marca" name="marca">
            <option value="">Selecione a marca</option>
            <option value="F" <?= $marca == 'F'  ? 'selected' : '' ?>>Fiat</option>
            <option value="V" <?= $marca == 'V'  ? 'selected' : '' ?>>Volkswagen</option>
            <option value="C" <?= $marca == 'C'  ? 'selected' : '' ?>>Chevrolet</option>
            <option value="Fo" <?= $marca == 'Fo' ? 'selected' : '' ?>>Ford</option>
            <option value="R" <?= $marca == 'R'  ? 'selected' : '' ?>>Renault</option>
            <option value="H" <?= $marca == 'H'  ? 'selected' : '' ?>>Honda</option>
            <option value="T" <?= $marca == 'T'  ? 'selected' : '' ?>>Toyota</option>
            <option value="O" <?= $marca == 'O'  ? 'selected' : '' ?>>Outro</option>
        </select><br><br>

        <label for="modelo">Modelo:</label><br>
        <input type="text" id="modelo" name="modelo" placeholder="Ex: Astra" value="<?= $modelo ?>"><br><br>

        <label for="ano">Ano:</label><br>
        <input type="number" id="ano" name="ano" placeholder="Ex: 2004" value="<?= $ano ?>"><br><br>

        <label for="cor">Cor:</label><br>
        <select id="cor" name="cor">
            <option value="">Selecione a cor</option>
            <option value="B" <?= $cor == 'B'  ? 'selected' : '' ?>>Branca</option>
            <option value="P" <?= $cor == 'P'  ? 'selected' : '' ?>>Preta</option>
            <option value="Pr" <?= $cor == 'Pr' ? 'selected' : '' ?>>Prata</option>
            <option value="V" <?= $cor == 'V'  ? 'selected' : '' ?>>Vermelha</option>
            <option value="A" <?= $cor == 'A'  ? 'selected' : '' ?>>Azul</option>
            <option value="C" <?= $cor == 'C'  ? 'selected' : '' ?>>Cinza</option>
            <option value="O" <?= $cor == 'O'  ? 'selected' : '' ?>>Outra</option>
        </select><br><br>

        <label for="km">Quilometragem:</label><br>
        <input type="number" id="km" name="km" value="<?= $km ?>"><br><br>

        <button type="submit">Cadastrar</button>
    </form>

</body>

</html>