<?php

namespace App\Model\Entidades;

class Repasse
{
    private int $id;
    private Mensalidade $mensalidade;
    private string $dataRepasse;
    private float $valorRepasse;
    private bool $repassado;

    public function __construct()
    {
        $this->mensalidade = new Mensalidade();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getMensalidade(): Mensalidade
    {
        return $this->mensalidade;
    }

    public function setMensalidade(Mensalidade $mensalidade)
    {
        $this->mensalidade = $mensalidade;
    }

    public function getDataRepasse(): string
    {
        return $this->dataRepasse;
    }

    public function setDataRepasse($dataRepasse)
    {
        $this->dataRepasse = $dataRepasse;
    }

    public function getValorRepasse(): float
    {
        return $this->valorRepasse;
    }

    public function setValorRepasse($valorRepasse)
    {
        $this->valorRepasse = $valorRepasse;
    }

    public function isRepassado(): bool
    {
        return $this->repassado;
    }

    public function setRepassado($repassado)
    {
        $this->repassado = $repassado;
    }
}