<?php

require_once("presidente.php");

function gerarLinhasTabela($lista)
{
    $linhas = '';
    foreach ($lista as $presidente) {
        $linhas .= "<tr>";
        $linhas .= "<td>" . $presidente->getNumero() . "</td>";
        $linhas .= "<td>" . $presidente->getNome() . "</td>";
        $linhas .= "<td>" . $presidente->getInicio() . "</td>";
        $linhas .= "<td>" . $presidente->getFim() . "</td>";
        $linhas .= "</tr>\n";
    }
    return $linhas;
}

$lista = array();

$presidente = new Presidente(16, "Eurico Gaspar Dutra", 1946, 1951);
array_push($lista, $presidente);
$presidente = new Presidente(17, "Getulio Vargas", 1951, 1954);
array_push($lista, $presidente);
$presidente = new Presidente(18, "Café Filho", 1954, 1955);
array_push($lista, $presidente);
$presidente = new Presidente(19, "Carlos Luz", 1955, 1955);
array_push($lista, $presidente);
$presidente = new Presidente(20, "Nereu Ramos", 1955, 1956);
array_push($lista, $presidente);
$presidente = new Presidente(21, "Juscelino Kubitschek", 1956, 1961);
array_push($lista, $presidente);

?>

<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Presidentes</h1>
    
    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Nome</th>
                <th>Início</th>
                <th>Fim</th>
            </tr>
        </thead>
        <tbody>
            <?php echo gerarLinhasTabela($lista); ?>
        </tbody>
    </table>
</body>

</html>