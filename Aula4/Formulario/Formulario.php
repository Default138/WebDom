<?php

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
</head>

<body>

    <h1>Formulário de Cadastro</h1>

    <form action="formulario_exec.php" method="POST">

        <label for="">Nome:</label>
        <input type="text" placeholder="Informe o nome"
            name="nome">

        <br><br>

        <label for="">Idade:</label>
        <input type="number" placeholder="Informe a idade"
            name="idade">

        <br><br>

        <select name="cor">
            <option value="">Selecione uma cor</option>
            <option value="Tomato">Vermelho</option>
            <option value="Orange">Laranja</option>
            <option value="DodgerBlue">Azul</option>
            <option value="MediumSeaGreen">Verde</option>
            <option value="Gray">Cinza</option>
            <option value="SlateBlue">Azul Escuro</option>
            <option value="Violet">Rosa</option>
        </select>

        <br><br>

        <button type="submit">Enviar</button>

    </form>

</body>

</html>