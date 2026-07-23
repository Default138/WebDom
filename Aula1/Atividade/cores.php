<?php
//array das cor ing
$cores = array(
    1 => "yellow",
    2 => "blue",
    3 => "black",
    4 => "green",
    5 => "red",
    6 => "purple",
    7 => "gray",
    8 => "brown"
);

foreach ($cores as $cor) {
    echo '<div style="background-color: ' . $cor . '; width: 100px; height: 100px;"></div>';
    echo $cor;
};