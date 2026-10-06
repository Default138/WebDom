<?php

class Usuario {
    private ?int $id = null;
    private ?string $nome = null;
    private ?string $email = null;
    private ?string $senha = null;
    private ?string $criado_em = null;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }

    public function getNome(): ?string { return $this->nome; }
    public function setNome(?string $nome): self { $this->nome = $nome; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }

    public function getSenha(): ?string { return $this->senha; }
    public function setSenha(?string $senha): self { $this->senha = $senha; return $this; }

    public function getCriadoEm(): ?string { return $this->criado_em; }
    public function setCriadoEm(?string $criado_em): self { $this->criado_em = $criado_em; return $this; }
}