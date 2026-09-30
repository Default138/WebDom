<?php

require_once(__DIR__ . "/Prioridade.php");
require_once(__DIR__ . "/Tema.php");

class Tarefa {
    //Definimos = null para inicializar os atributos com valor nulo por padrão
    private ?int $id = null;
    private ?string $titulo = null;
    private ?string $descricao = null;
    private ?string $data_entrega = null; // formato YYYY-MM-DD
    private ?Prioridade $prioridade = null;
    private ?Tema $tema = null;
    private ?string $criado_em = null;

    //Getters e Setters
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }

    public function getTitulo(): ?string { return $this->titulo; }
    public function setTitulo(?string $titulo): self { $this->titulo = $titulo; return $this; }

    public function getDescricao(): ?string { return $this->descricao; }
    public function setDescricao(?string $descricao): self { $this->descricao = $descricao; return $this; }

    public function getDataEntrega(): ?string { return $this->data_entrega; }
    public function setDataEntrega(?string $data_entrega): self { $this->data_entrega = $data_entrega; return $this; }

    public function getPrioridade(): ?Prioridade { return $this->prioridade; }
    public function setPrioridade(?Prioridade $prioridade): self { $this->prioridade = $prioridade; return $this; }

    public function getTema(): ?Tema { return $this->tema; }
    public function setTema(?Tema $tema): self { $this->tema = $tema; return $this; }

    public function getCriadoEm(): ?string { return $this->criado_em; }
    public function setCriadoEm(?string $criado_em): self { $this->criado_em = $criado_em; return $this; }
}