<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding: 50px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 0 500px rgba(98, 255, 0, 0.1);
        }

        .menu {
            margin-top: 30px;
        }

        .menu a {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }

        .menu a:hover {
            background-color: #45a049;
        }

        .regras {
            text-align: left;
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🎯 Jogo da Adivinhação</h1>
        <p>Tente adivinhar o Carro secreto (Celta, Corsa, Gol, Astra ou Marea)!</p>

        <div class="menu">
            <a href="jogo.php?palpite=1">Celta</a>
            <a href="jogo.php?palpite=2">Peugeot 206</a>
            <a href="jogo.php?palpite=3">Gol</a>
            <a href="jogo.php?palpite=4">Astra</a>
            <a href="jogo.php?palpite=5">Marea</a>
        </div>

        <!-- Por dicas no inicio -->


        <div class="regras">
            <h3>📝 Regras do Jogo:</h3>
            <ul>
                <li>O jogo escolhe um Carro aleatoriamente</li>
                <li>Você precisa adivinhar qual Carro foi escolhido</li>
                <li>Boa sorte! 🍀</li>
            </ul>
        </div>
    </div>
</body>

</html>