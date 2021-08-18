<?php

namespace App\Model\Entidades;

class Mensalidade
{
    private int $id;
    private Contrato $contrato;
    private int $numeroMensalidade;
    private bool $flPago;
    private float $valorMensalidade;

    public function __construct()
    {
        $this->contrato = new Contrato();
    }
    
    /**
     * Get the value of id
     */ 
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */ 
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of contrato
     */ 
    public function getContrato(): Contrato
    {
        return $this->contrato;
    }

    /**
     * Set the value of contrato
     */ 
    public function setContrato(Contrato $contrato)
    {
        $this->contrato = $contrato;
    }

    /**
     * Get the value of numeroMensalidade
     */ 
    public function getNumeroMensalidade(): int
    {
        return $this->numeroMensalidade;
    }

    /**
     * Set the value of numeroMensalidade
     */ 
    public function setNumeroMensalidade($numeroMensalidade)
    {
        $this->numeroMensalidade = $numeroMensalidade;
    }

    /**
     * Get the value of flPago
     */ 
    public function isFlPago(): bool
    {
        return $this->flPago;
    }

    /**
     * Set the value of flPago
     */ 
    public function setFlPago($flPago)
    {
        $this->flPago = $flPago;
    }

    /**
     * Get the value of valorMensalidade
     */ 
    public function getValorMensalidade(): float
    {
        return $this->valorMensalidade;
    }

    /**
     * Set the value of valorMensalidade
     */ 
    public function setValorMensalidade($valorMensalidade)
    {
        $this->valorMensalidade = $valorMensalidade;
    }

}