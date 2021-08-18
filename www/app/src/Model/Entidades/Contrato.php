<?php

namespace App\Model\Entidades;

class Contrato
{
    private int $id;
    private Imovel $imovel;
    private Locador $locador;
    private Locatario $locatario;
    private string $dataInicio;
    private string $dataTermino;
    private float $taxaAdministracao;
    private float $valorAluguel;
    private float $valorCondominio;
    private float $valorIptu;

    public function __construct()
    {
        $this->imovel = new Imovel();
        $this->locador = new Locador();
        $this->locatario = new Locatario();
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
     * Get the value of imovel
     */ 
    public function getImovel(): Imovel
    {
        return $this->imovel;
    }

    /**
     * Set the value of imovel
     */ 
    public function setImovel(Imovel $imovel)
    {
        $this->imovel = $imovel;
    }

    /**
     * Get the value of locador
     */ 
    public function getLocador(): Locador
    {
        return $this->locador;
    }

    /**
     * Set the value of locador
     */ 
    public function setLocador(Locador $locador)
    {
        $this->locador = $locador;
    }

    /**
     * Get the value of locatario
     */ 
    public function getLocatario(): Locatario
    {
        return $this->locatario;
    }

    /**
     * Set the value of locatario
     */ 
    public function setLocatario(Locatario $locatario)
    {
        $this->locatario = $locatario;
    }

    /**
     * Get the value of dataInicio
     */ 
    public function getDataInicio(): string
    {
        return $this->dataInicio;
    }

    /**
     * Set the value of dataInicio
     */ 
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;
    }

    /**
     * Get the value of dataTermino
     */ 
    public function getDataTermino(): string
    {
        return $this->dataTermino;
    }

    /**
     * Set the value of dataTermino
     */ 
    public function setDataTermino($dataTermino)
    {
        $this->dataTermino = $dataTermino;
    }

    /**
     * Get the value of taxaAdministracao
     */ 
    public function getTaxaAdministracao(): float
    {
        return $this->taxaAdministracao;
    }

    /**
     * Set the value of taxaAdministracao
     */ 
    public function setTaxaAdministracao($taxaAdministracao)
    {
        $this->taxaAdministracao = $taxaAdministracao;
    }

    /**
     * Get the value of valorAluguel
     */ 
    public function getValorAluguel(): float
    {
        return $this->valorAluguel;
    }

    /**
     * Set the value of valorAluguel
     */ 
    public function setValorAluguel($valorAluguel)
    {
        $this->valorAluguel = $valorAluguel;
    }

    /**
     * Get the value of valorCondominio
     */ 
    public function getValorCondominio(): float
    {
        return $this->valorCondominio;
    }

    /**
     * Set the value of valorCondominio
     */ 
    public function setValorCondominio($valorCondominio)
    {
        $this->valorCondominio = $valorCondominio;
    }

    /**
     * Get the value of valorIptu
     */ 
    public function getValorIptu(): float
    {
        return $this->valorIptu;
    }

    /**
     * Set the value of valorIptu
     */ 
    public function setValorIptu($valorIptu)
    {
        $this->valorIptu = $valorIptu;
    }

}