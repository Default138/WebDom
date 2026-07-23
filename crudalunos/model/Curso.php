<?php

class Curso {
    private ?int $id;
    private ?string $nome;
    private ?string $turno;

    /*
    public function __construct(int $id, string $nome, string $turno) {
        $this->id = $id;
        $this->nome = $nome;
        $this->turno = $turno;

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of turno
     */
    public function getTurno(): ?string
    {
        return $this->turno;
    }

    public function getTurnoDesc() {
        switch ($this->turno) {
            case 'M':
                return 'Matutino';
            case 'V':
                return 'Vespertino';
            case 'N':
                return 'Noturno';
            default:
                return 'Turno desconhecido';
        }
    }

    public function __toString() {
        return $this->nome . " (" . $this->getTurnoDesc() . ")";
    }

    /**
     * Set the value of turno
     */
    public function setTurno(?string $turno): self
    {
        $this->turno = $turno;

        return $this;
    }
}    