<?php

require_once 'modelo/Palpite.php';

$palpite1 = new Palpite(1, "Celta", "https://imgs.search.brave.com/LiiEYX2Efxo0CAMvGtiF3bOlLR2Dq6HpCVBsuIFmKXw/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZTEubW9iaWF1dG8u/Y29tLmJyL2ltYWdl/cy9hcGkvaW1hZ2Vz/L3YxLjAvNDUxMTQw/OTk4L3RyYW5zZm9y/bS9mbF9wcm9ncmVz/c2l2ZSxmX3dlYnAs/cV83MCx3XzY0MA", "Raça de um Guerreiro");
$palpite2 = new Palpite(2, "Peugeot 206", "https://imgs.search.brave.com/nV5iobwoVlT0C3py7S4ynuS2zkA4nJ6nwWBiMCMkuVY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9odHRw/Mi5tbHN0YXRpYy5j/b20vRF9OUV9OUF8y/WF82MzczNDUtTUxC/OTQxMzY5ODA0OTRf/MTAyMDI1LUUtcGV1/Z2VvdC0yMDYtMTAt/MTZ2LXNlbGVjdGlv/bi1wYWNrLTVwLndl/YnA", "Odiado por todos e medo dos mecânicos");
$palpite3 = new Palpite(3, "Gol", "https://imgs.search.brave.com/zp4Xh3LJYOb75_zNPilKnbcvo-QNG8AsZJ92iyAqduU/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jcm8u/aS51b2wuY29tLmJy/L2FsYnVtL25vdm9f/Z29sX2ZfMDAyLmpw/Zw", "Adorado no Brasil pelo nome ter relação com o Futebol");
$palpite4 = new Palpite(4, "Astra", "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Chevrolet_Astra_2.0_GLS_2006_%2816088287360%29.jpg/1280px-Chevrolet_Astra_2.0_GLS_2006_%2816088287360%29.jpg", "Conhecido como Cara de Trem");
$palpite5 = new Palpite(5, "Marea", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdLriC6U2KTawlGva7b4SUlIWKTMZmtIps2Q&s", "Conhecido carinhosamente como Bomba");


$todosPalpites = array($palpite1, $palpite2, $palpite3, $palpite4, $palpite5);

$indiceAleatorio = rand(0, 4);
$palpiteCorreto = $todosPalpites[$indiceAleatorio];

if (isset($_GET['palpite'])) {
    $palpiteUsuario = $_GET['palpite'];

    if ($palpiteUsuario == $palpiteCorreto->getId()) {
        $mensagem = "PARABÉNS! Você acertou! 🎉";
        $tipo = "acertou";
    } else {
        $mensagem = "Que pena! Você errou! 😞";
        $tipo = "errou";
    }
} else {
    $mensagem = "ERRO: Você não informou um palpite!";
    $tipo = "erro";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Jogo da Adivinhação - Resultado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .acertou {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .errou {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .erro {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card {
            border: 2px solid #333;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            display: inline-block;
        }

        .card img {
            max-width: 150px;
            border-radius: 10px;
        }

        .dica {
            background-color: #e7f3ff;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        .botao {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
        }

        .botao:hover {
            background-color: #0056b3;
        }

        .voltar {
            background-color: #6c757d;
        }

        .voltar:hover {
            background-color: #5a6268;
        }

        .tentativa {
            font-size: 18px;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🎯 Resultado do Jogo</h1>

        <div class="<?php echo $tipo; ?>">
            <h2><?php echo $mensagem; ?></h2>
        </div>

        <?php if (isset($_GET['palpite'])): ?>
            <div class="tentativa">
                <strong>Seu palpite foi:</strong> <?php echo $_GET['palpite']; ?>
            </div>
        <?php endif; ?>

        <!-- Se acertar -->
        <?php if ($tipo == "acertou"): ?>
            <div class="card">
                <h3>🎉 Você adivinhou o Carro:</h3>
                <img src="<?php echo $palpiteCorreto->getImagem(); ?>"
                    alt="<?php echo $palpiteCorreto->getNome(); ?>">
                <h2><?php echo $palpiteCorreto->getNome(); ?></h2>
                <div class="dica">
                    <strong>Dica:</strong> <?php echo $palpiteCorreto->getDica(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Se Errar -->
        <?php if ($tipo == "errou"): ?>
            <div class="card">
                <h3>🔍 O Carro correto era:</h3>
                <img src="<?php echo $palpiteCorreto->getImagem(); ?>"
                    alt="<?php echo $palpiteCorreto->getNome(); ?>">
                <h2><?php echo $palpiteCorreto->getNome(); ?></h2>
                <div class="dica">
                    <strong>Dica:</strong> <?php echo $palpiteCorreto->getDica(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Div do botão/link/endereço -->
        <div>
            <a href="jogo.php?palpite=1" class="botao">Celta</a>
            <a href="jogo.php?palpite=2" class="botao">Peugeot 206</a>
            <a href="jogo.php?palpite=3" class="botao">Gol</a>
            <a href="jogo.php?palpite=4" class="botao">Astra</a>
            <a href="jogo.php?palpite=5" class="botao">Marea</a>
        </div>

        <div>
            <a href="index.php" class="botao voltar">← Voltar ao Início</a>
            <a href="jogo.php" class="botao">🎲 Novo Jogo</a>
        </div>

    </div>
</body>

</html>