<?php

require_once 'modelo/Veiculo.php';

$modelo = $_POST['modelo'];
$marca = $_POST['marca'];
$combustivel = $_POST['combustivel'];

$veiculo = new Veiculo($modelo, $marca, $combustivel);

if ($veiculo->getCombustivel() == "A") {
    $nomeCombustivel = "Alcool";
} elseif ($veiculo->getCombustivel() == "G") {
    $nomeCombustivel = "Gasolina";
} elseif ($veiculo->getCombustivel() == "D") {
    $nomeCombustivel = "Diesel";
} elseif ($veiculo->getCombustivel() == "F") {
    $nomeCombustivel = "Flex";
} else {
    $nomeCombustivel = $veiculo->getCombustivel();
}

echo "<h1>Dados do veiculo</h1>";
echo "Modelo: " . $veiculo->getModelo() . "<br>";
echo "Marca: " . $veiculo->getMarca() . "<br>";
echo "Combustivel: " . $nomeCombustivel . "<br>";

echo "<br><br>";
echo "<a href='veiculo_form.php'>Cadastrar outro Veículo</a>";