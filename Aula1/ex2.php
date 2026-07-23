<?php

function media($n1, $n2, $n3) {
    $media = ($n1 + $n2 + $n3) / 3;
    return $media;
}

$media1 = media(3, 4, 5);

$media2 = media(6, 7, 8);

$media3 = media(9, 10, 11);

echo "A média 1 é: $media1 <br>";
echo "A média 2 é: $media2 <br>";
echo "A média 3 é: $media3 <br>";