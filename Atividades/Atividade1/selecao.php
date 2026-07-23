<?php

function gerarLinhaTabela($numero, $nome, $corFundo) {
    if ($corFundo == "Amarelo") {
        $cor = "#ffff00";
    } else if ($corFundo == "Verde") {
        $cor = "#00ff00";
    }
    
    return "<tr style='background-color: $cor'>
                <td>$numero</td>
                <td>$nome</td>
            </tr>";
}

$jogadores = array(
    [1, "Tafarel", "Verde"],
    [2, "Jorginho", "Amarelo"],
    [13, "Aldair", "Verde"],
    [15, "Márcio Santos", "Amarelo"],
    [6, "Branco", "Verde"],
    [5, "Mauro Silva", "Amarelo"],
    [8, "Dunga", "Verde"],
    [17, "Mazinho", "Amarelo"],
    [9, "Zinho", "Verde"],
    [11, "Romário", "Amarelo"],
    [7, "Beto", "Verde"],
);
?>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
        }
        th {
            background-color: #333;
            color: white;
            padding: 10px;
            border: 1px solid #333;
        }
        td {
            padding: 8px;
            border: 1px solid #333;
        }
    </style>
</head>

<body>

    <h1 style="text-align: center;">Seleção Brasileira Campeã Mundial 1994</h1>
    
    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Nome</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            foreach ($jogadores as $jogador) {
                echo gerarLinhaTabela($jogador[0], $jogador[1], $jogador[2]);
            }
            ?>
        </tbody>
    </table>
</body>
</html>