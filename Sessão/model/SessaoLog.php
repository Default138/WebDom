<?php

class SessaoLog {
    private ?int $id = null;
    private ?string $acao = null;
    private ?string $valor = null;
    private ?string $criado_em = null;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }

    public function getAcao(): ?string { return $this->acao; }
    public function setAcao(?string $acao): self { $this->acao = $acao; return $this; }

    public function getValor(): ?string { return $this->valor; }
    public function setValor(?string $valor): self { $this->valor = $valor; return $this; }

    public function getCriadoEm(): ?string { return $this->criado_em; }
    public function setCriadoEm(?string $criado_em): self { $this->criado_em = $criado_em; return $this; }
}