<?php

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Veiculos</title>
</head>

<body>

    <h2>Digite os dados do veiculo</h2>

    <form method="POST" action="veiculo_exec.php">

        <input name="modelo" placeholder="Informe o modelo" />

        <br><br>

        <input name="marca" placeholder="Informe a marca" />

        <br><br>

        <select name="combustivel">
            <option value="">Selecione o combustivel</option>
            <option value="G">Gasolina</option>
            <option value="A">Alcool</option>
            <option value="D">Diesel</option>
            <option value="F">Flex</option>
        </select>

        <br><br>

        <button type="submit">Enviar</button>

    </form>

</body>