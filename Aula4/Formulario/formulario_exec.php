<?php

$nome = $_POST['nome'];
$idade = $_POST['idade'];
$cor = $_POST['cor'];

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados Cadastrados</title>
    <style>
        body {
            background-color: <?php echo $cor; ?>;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Dados Cadastrados</h1>

        <?php
        echo "O nome informado foi: " . $nome;
        echo "<br>";
        echo "A idade informada foi: " . $idade;
        ?>

        <br><br>
        <a href="Formulario.php">Voltar ao formulario</a>
    </div>
</body>

</html>