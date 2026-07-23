<?php

class Palpite {
    public $id;
    public $nome;
    public $imagem;
    public $dica;
    
    //construtor
    public function __construct($id, $nome, $imagem, $dica) {
        $this->id = $id;
        $this->nome = $nome;
        $this->imagem = $imagem;
        $this->dica = $dica;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of imagem
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     */
    public function setImagem($imagem): self
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get the value of dica
     */
    public function getDica()
    {
        return $this->dica;
    }

        /**
         * Set the value of dica
         */
        public function setDica($dica): self
        {
            $this->dica = $dica;
    
            return $this;
        }
    }

    