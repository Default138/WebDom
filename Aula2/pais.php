<?php

$pais1 = array(
    "Ordem" => 1,
    "País" => "🇺🇸 USA - Estado Unidos",
    "Ouro" => 46,
    "Prata" => 37,
    "Bronze" => 38,
    "Total" => 121,
);

$pais2 = array(
    "Ordem" => 2,
    "País" => "🇬🇧 GBR - Grã-Bretanha",
    "Ouro" => 27,
    "Prata" => 23,
    "Bronze" => 17,
    "Total" => 67,
);

$pais3 = array(
    "Ordem" => 3,
    "País" => "🇨🇳 CHN - China",
    "Ouro" => 26,
    "Prata" => 18,
    "Bronze" => 26,
    "Total" => 70,
);

$pais4 = array(
    "Ordem" => 4,
    "País" => "🇷🇺 RUS - Rússia",
    "Ouro" => 19,
    "Prata" => 17,
    "Bronze" => 20,
    "Total" => 56,
);

$pais5 = array(
    "Ordem" => 5,
    "País" => "🇩🇪 GER - Alemanha",
    "Ouro" => 17,
    "Prata" => 10,
    "Bronze" => 15,
    "Total" => 42,
);

$tabela = array($pais1, $pais2, $pais3, $pais4, $pais5);

function imprimirLinhasTabela($matriz)
{
    foreach ($matriz as $pais) {
        echo "<tr>";
        echo "<td>" . $pais["Ordem"] . "</td>";
        echo "<td>" . $pais["País"] . "</td>";
        echo "<td>" . $pais["Ouro"] . "</td>";
        echo "<td>" . $pais["Prata"] . "</td>";
        echo "<td>" . $pais["Bronze"] . "</td>";
        echo "<td>" . $pais["Total"] . "</td>";
        echo "</tr>";
    }
}
?>

<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #ffffff;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">Tabela Medalahas</h2>

    <table>
        <thead>
            <tr>
                <th>Ordem</th>
                <th>País</th>
                <th>Ouro</th>
                <th>Prata</th>
                <th>Bronze</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            imprimirLinhasTabela($tabela);
            ?>
        </tbody>
    </table>
</body>

</html>