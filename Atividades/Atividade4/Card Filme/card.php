<?php

require_once 'modelo/Filme.php';

$filme = new Filme();
$filme->setNome($_POST['nome'])
      ->setAno($_POST['ano'])
      ->setGenero($_POST['genero']);

$sinopse = $_POST['sinopse'];

if ($filme->getGenero() == "Ação") {
    $filme->setImagem("https://imgs.search.brave.com/Y-NfBeMZG4eWPpKCBJ9JuWzQPrK6vpl5YE9Tw7YxKGY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/bWFnYXppbmUtaGQu/Y29tL2FwcHMvd3Av/d3AtY29udGVudC91/cGxvYWRzLzIwMjUv/MDQvZXN0ZXMtc2Fv/LW9zLTEwLWZpbG1l/cy1kZS1hY2FvLW1h/aXMtc3VycHJlZW5k/ZW50ZXMtZG8tY2lu/ZW1hLW1vZGVybm8u/d2VicA");
} elseif ($filme->getGenero() == "Comédia") {
    $filme->setImagem("https://imgs.search.brave.com/8qKClcQO4S7EIOCCcWk4FCrVrxZm83Rfa6B5mwcGmYA/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9va2Nv/bWVudGVpLmNvbS5i/ci93cC1jb250ZW50/L3VwbG9hZHMvMjAy/NS8wNy9maWxtZXMt/ZGUtdGVycm9yLWUt/Y29tZWRpYS0yLTEw/MjR4NjgzLmpwZw");
} elseif ($filme->getGenero() == "Drama") {
    $filme->setImagem("https://imgs.search.brave.com/pHtRXQLG6GRnzHLe4rqkwNHz46AGcEgCHqqRGR9l4IE/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly93d3cu/ZGljYXNkZW11bGhl/ci5jb20uYnIvd3At/Y29udGVudC91cGxv/YWRzLzIwMTkvMDIv/ZmlsbWVzLWRlLWRy/YW1hLTEuanBn");
} elseif ($filme->getGenero() == "Ficção Científica") {
    $filme->setImagem("https://imgs.search.brave.com/gpJQasxHyJ89HvrQJmJ1cKmg6lsCSxlsPsaj90K6I8U/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9tZWRp/YS5nZXR0eWltYWdl/cy5jb20vaWQvMTM2/MTU5MDMzOS9wdC9m/b3RvL3NlbGZpZS1v/dXQtb2YtdGhpcy13/b3JsZC1hc3Ryb25h/dXRzLWluLWZ1dHVy/aXN0aWMtc3VpdHMt/dGFraW5nLXBob3Rv/LWFuZC1zZXR0aW5n/LXRoZS1saWdodC5q/cGc_cz02MTJ4NjEy/Jnc9MCZrPTIwJmM9/Y201TzFNeXN4cDJZ/b2tsalNxOHB6Vi1X/ME8xX0FwdHBZNFcw/cUhTYWp5WT0");
} elseif ($filme->getGenero() == "Terror") {
    $filme->setImagem("https://imgs.search.brave.com/RCOlkP6nX4W0kI9hd-eO5Yt-IQlI_lb-uBc1GDwix4k/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9pbWcu/b2RjZG4uY29tLmJy/L3dwLWNvbnRlbnQv/dXBsb2Fkcy8yMDI0/LzEyL3Bhbmljby01/LTEwMjR4NTc2Lmpw/Zw");
} else {
    $filme->setImagem("");
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card do Filme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .card-conteudo {
            padding: 20px;
            text-align: center;
        }
        .card h1 {
            color: #333;
            margin-bottom: 5px;
        }
        .card .ano {
            color: #666;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .card .genero {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .card .sinopse {
            text-align: left;
            line-height: 1.6;
            color: #555;
        }
        .voltar {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .voltar:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <img src="<?php echo $filme->getImagem(); ?>" alt="<?php echo $filme->getGenero(); ?>">
            <div class="card-conteudo">
                <h1><?php echo $filme->getNome(); ?></h1>
                <div class="ano">📅 <?php echo $filme->getAno(); ?></div>
                <div class="genero">🎭 <?php echo $filme->getGenero(); ?></div>
                <div class="sinopse">
                    <strong>Sinopse:</strong><br>
                    <?php echo $sinopse; ?>
                </div>
            </div>
        </div>
        
        <br>
        <a href="formulario.php" class="voltar"> <-- Voltar ao formulário</a>
    </div>
</body>

</html>