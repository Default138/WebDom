<?php

//exibi erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();

$msgError = "";

$marca = "";
$marca_outro = "";
$modelo = "";
$ano = "";
$cor = "";
$cor_outro = "";
$km = "";

//Salva os Carros
if (isset($_POST['marca'])) {
    $marca = trim($_POST['marca']) ? trim($_POST['marca']) : null;
    $modelo = trim($_POST['modelo']) ? trim($_POST['modelo']) : null;
    $ano = trim($_POST['ano']) ? trim($_POST['ano']) : null;
    $cor = trim($_POST['cor']) ? trim($_POST['cor']) : null;
    $km = trim($_POST['km']) ? trim($_POST['km']) : null;

    // Captura os campos de texto livre para "Outro"
    $marca_outro = isset($_POST['marca_outro']) ? trim($_POST['marca_outro']) : '';
    $cor_outro   = isset($_POST['cor_outro'])   ? trim($_POST['cor_outro'])   : '';

    $msgs = array();

    if (!$marca) {
        array_push($msgs, "A marca é obrigatória.");
    } else if ($marca === 'O' && !$marca_outro) {
        array_push($msgs, "Por favor, informe a marca no campo 'Outro'.");
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
    } else if ($cor === 'O' && !$cor_outro) {
        array_push($msgs, "Por favor, informe a cor no campo 'Outra'.");
    }

    if (!$km) {
        array_push($msgs, "A Quilometragem é obrigatória.");
    } else if (!is_numeric($km) || $km <= 0) {
        array_push($msgs, "A Quilometragem deve ser um número não negativo.");
    }

    if (empty($msgs)) {
        // Se for "Outro", salva o texto digitado pelo usuário no banco
        $marca_salvar = ($marca === 'O') ? $marca_outro : $marca;
        $cor_salvar   = ($cor   === 'O') ? $cor_outro   : $cor;

        $sql = "INSERT INTO Carro (Marca, Modelo, Ano, Cor, Km) VALUES (?, ?, ?, ?, ?)";
        $stm = $conexao->prepare($sql);
        $stm->execute([$marca_salvar, $modelo, $ano, $cor_salvar, $km]);

        header("location: carro_outro.php");
        exit;
    } else {
        $msgError = implode("<br>", $msgs);
    }
}

$sql = "SELECT * FROM Carro";
$stm = $conexao->prepare($sql);
$stm->execute();
$carros = $stm->fetchAll();

// Função auxiliar: retorna o nome legível da marca
function nomeMarca($codigo) {
    $marcas = [
        'F'  => 'Fiat',
        'V'  => 'Volkswagen',
        'C'  => 'Chevrolet',
        'Fo' => 'Ford',
        'R'  => 'Renault',
        'H'  => 'Honda',
        'T'  => 'Toyota',
    ];
    // Se o código está no mapa, retorna o nome; senão, exibe o próprio valor (é um "outro" personalizado)
    return $marcas[$codigo] ?? $codigo;
}

// Função auxiliar: retorna o nome legível da cor
function nomeCor($codigo) {
    $cores = [
        'B'  => 'Branca',
        'P'  => 'Preta',
        'Pr' => 'Prata',
        'V'  => 'Vermelha',
        'A'  => 'Azul',
        'C'  => 'Cinza',
    ];
    return $cores[$codigo] ?? $codigo;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Carros</title>
    <link rel="stylesheet" href="util/style.css">
    <style>
        /* Campo "outro" começa escondido e aparece com transição suave */
        .campo-outro {
            display: none;
            margin-top: 6px;
        }
        .campo-outro.visivel {
            display: block;
        }
    </style>
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
                <td><?= htmlspecialchars(nomeMarca($carro['Marca'])) ?></td>
                <td><?= htmlspecialchars($carro['Modelo']) ?></td>
                <td><?= $carro['Ano'] ?></td>
                <td><?= htmlspecialchars(nomeCor($carro['Cor'])) ?></td>
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
        <select id="marca" name="marca" onchange="toggleOutro('marca', 'O', 'campo-marca-outro')">
            <option value="">Selecione a marca</option>
            <option value="F"  <?= $marca == 'F'  ? 'selected' : '' ?>>Fiat</option>
            <option value="V"  <?= $marca == 'V'  ? 'selected' : '' ?>>Volkswagen</option>
            <option value="C"  <?= $marca == 'C'  ? 'selected' : '' ?>>Chevrolet</option>
            <option value="Fo" <?= $marca == 'Fo' ? 'selected' : '' ?>>Ford</option>
            <option value="R"  <?= $marca == 'R'  ? 'selected' : '' ?>>Renault</option>
            <option value="H"  <?= $marca == 'H'  ? 'selected' : '' ?>>Honda</option>
            <option value="T"  <?= $marca == 'T'  ? 'selected' : '' ?>>Toyota</option>
            <option value="O"  <?= $marca == 'O'  ? 'selected' : '' ?>>Outro</option>
        </select>
        <div id="campo-marca-outro" class="campo-outro <?= $marca == 'O' ? 'visivel' : '' ?>">
            <input type="text" id="marca_outro" name="marca_outro"
                   placeholder="Digite a marca"
                   value="<?= htmlspecialchars($marca_outro) ?>">
        </div>
        <br>

        <label for="modelo">Modelo:</label><br>
        <input type="text" id="modelo" name="modelo" placeholder="Ex: Astra" value="<?= htmlspecialchars($modelo) ?>"><br><br>

        <label for="ano">Ano:</label><br>
        <input type="number" id="ano" name="ano" placeholder="Ex: 2004" value="<?= $ano ?>"><br><br>

        <label for="cor">Cor:</label><br>
        <select id="cor" name="cor" onchange="toggleOutro('cor', 'O', 'campo-cor-outro')">
            <option value="">Selecione a cor</option>
            <option value="B"  <?= $cor == 'B'  ? 'selected' : '' ?>>Branca</option>
            <option value="P"  <?= $cor == 'P'  ? 'selected' : '' ?>>Preta</option>
            <option value="Pr" <?= $cor == 'Pr' ? 'selected' : '' ?>>Prata</option>
            <option value="V"  <?= $cor == 'V'  ? 'selected' : '' ?>>Vermelha</option>
            <option value="A"  <?= $cor == 'A'  ? 'selected' : '' ?>>Azul</option>
            <option value="C"  <?= $cor == 'C'  ? 'selected' : '' ?>>Cinza</option>
            <option value="O"  <?= $cor == 'O'  ? 'selected' : '' ?>>Outra</option>
        </select>
        <div id="campo-cor-outro" class="campo-outro <?= $cor == 'O' ? 'visivel' : '' ?>">
            <input type="text" id="cor_outro" name="cor_outro"
                   placeholder="Digite a cor"
                   value="<?= htmlspecialchars($cor_outro) ?>">
        </div>
        <br>

        <label for="km">Quilometragem:</label><br>
        <input type="number" id="km" name="km" value="<?= $km ?>"><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <script>
        /**
         * Exibe ou oculta o campo de texto livre.
         * @param {string} selectId   - id do <select>
         * @param {string} gatilho    - valor que ativa o campo ("O")
         * @param {string} divId      - id da <div> que contém o <input>
         */
        function toggleOutro(selectId, gatilho, divId) {
            var select = document.getElementById(selectId);
            var div    = document.getElementById(divId);

            if (select.value === gatilho) {
                div.classList.add('visivel');
                div.querySelector('input').focus();
            } else {
                div.classList.remove('visivel');
                div.querySelector('input').value = ''; // limpa ao trocar de opção
            }
        }
    </script>
</body>

</html>
