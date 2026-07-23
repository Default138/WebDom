<?php

//array dos carrin

$container= array();

$carro1 = array(
    "modelo" => "Gol G1",
    "marca" => "Volkswagen",
    "foto" => "https://i.pinimg.com/736x/6f/7f/91/6f7f9195cb89b72fb00de5c03621ecc3.jpg"
);  array_push($container, $carro1);

$carro2 = array(
    "modelo" => "Astra",
    "marca" => "Chevrolet",
    "foto" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzMXE3vyGKopX8AcIAbL7qiwbpOdAYHA8fqA&s"
);  array_push($container, $carro2);

$carro3 = array(
    "modelo" => "Ka",
    "marca" => "Ford",
    "foto" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQh58GYnJhBXlFpSUyE29hibUGWQ3xBpZcxeg&s"
);  array_push($container, $carro3);

$carro4 = array(
    "modelo" => "Corolla",
    "marca" => "Toyota",
    "foto" => "https://preview.redd.it/bagged-toyota-corolla-v0-gbnf8eyijphd1.jpeg?auto=webp&s=c54698c9be09b4d7ed2f0a2ee6e5742bb8ec445c"
);  array_push($container, $carro4);

$carro5 = array(
    "modelo" => "Civic",
    "marca" => "Honda",
    "foto" => "https://i.pinimg.com/736x/f0/2e/5d/f02e5d7de5cb7dbafe93bf7b79fa71c6.jpg"
);  array_push($container, $carro5);

foreach ($container as $carro) {
    echo '<div style="border: solid 1px; width: 300px; margin-top: 20px;">
'.$carro["modelo"].'<br>
'.$carro["marca"].'<br>
<img style="width: 100%; height: auto;" src="'.$carro["foto"].'" ><hr>
</div>';
}