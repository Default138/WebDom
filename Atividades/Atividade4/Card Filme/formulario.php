<?php
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Cards - Filmes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 50px;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>🎬 Gerador de Cards de Filmes</h2>

        <form action="card.php" method="POST">
            <label>Nome do Filme:</label>
            <input type="text" name="nome" placeholder="Ex: Interestelar" required>

            <br>

            <label>Ano de Lançamento:</label>
            <input type="number" name="ano" placeholder="Ex: 2014" required>

            <br>

            <label>Gênero:</label>
            <select name="genero" required>
                <option value="">Selecione o gênero</option>
                <option value="Ação">Ação</option>
                <option value="Comédia">Comédia</option>
                <option value="Drama">Drama</option>
                <option value="Ficção Científica">Ficção Científica</option>
                <option value="Terror">Terror</option>
            </select>

            <br>

            <label>Sinopse:</label>
            <textarea name="sinopse" rows="4" placeholder="Digite a sinopse do filme..." required></textarea>

            <button type="submit">Gerar Card</button>
        </form>
    </div>
</body>

</html>