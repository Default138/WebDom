<?php

class Veiculo
{
    public $modelo;
    public $marca;
    public $combustivel;

    function __construct($modelo, $marca, $combustivel)
    {
        $this->modelo = $modelo;
        $this->marca = $marca;
        $this->combustivel = $combustivel;
    }

    /**
     * Get the value of modelo
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set the value of modelo
     */
    public function setModelo($modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get the value of marca
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set the value of marca
     */
    public function setMarca($marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get the value of combustivel
     */
    public function getCombustivel()
    {
        return $this->combustivel;
    }

    /**
     * Set the value of combustivel
     */
    public function setCombustivel($combustivel): self
    {
        $this->combustivel = $combustivel;

        return $this;
    }
}
