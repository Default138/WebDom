<?php

$retangulo1 = array( 
    'base' => 5,
    'altura' => 10
);

$retangulo2 = array(
    'base' => 7,
    'altura' => 14
);

$retangulo3 = array(
    'base' => 8,
    'altura' => 16,
);

$retangulos = array($retangulo1, $retangulo2, $retangulo3);

foreach ($retangulos as $index => $retangulo) {
    $area = $retangulo['base'] * $retangulo['altura'];
    echo "A área do retângulo " . ($index + 1) . " é: $area <br>";
}