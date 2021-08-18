<?php

namespace App\Model\Entidades;

class Imovel
{
    private int $id;
    private Locador $locador;
    private string $ruaEndereco;
    private string $numeroEndereco;
    private string $complementoEndereco;
    private string $bairroEndereco;
    private string $cidadeEndereco;
    private string $ufEndereco;

    public function __construct()
    {
        $this->locador = new Locador();
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
     * Get the value of ruaEndereco
     */ 
    public function getRuaEndereco(): string
    {
        return $this->ruaEndereco;
    }

    /**
     * Set the value of ruaEndereco
     */ 
    public function setRuaEndereco($ruaEndereco)
    {
        $this->ruaEndereco = $ruaEndereco;
    }

    /**
     * Get the value of numeroEndereco
     */ 
    public function getNumeroEndereco(): string
    {
        return $this->numeroEndereco;
    }

    /**
     * Set the value of numeroEndereco
     */ 
    public function setNumeroEndereco($numeroEndereco)
    {
        $this->numeroEndereco = $numeroEndereco;
    }

    /**
     * Get the value of complementoEndereco
     */ 
    public function getComplementoEndereco(): string
    {
        return $this->complementoEndereco;
    }

    /**
     * Set the value of complementoEndereco
     */ 
    public function setComplementoEndereco($complementoEndereco)
    {
        $this->complementoEndereco = $complementoEndereco;
    }

    /**
     * Get the value of bairroEndereco
     */ 
    public function getBairroEndereco(): string
    {
        return $this->bairroEndereco;
    }

    /**
     * Set the value of bairroEndereco
     */ 
    public function setBairroEndereco($bairroEndereco)
    {
        $this->bairroEndereco = $bairroEndereco;
    }

    /**
     * Get the value of cidadeEndereco
     */ 
    public function getCidadeEndereco(): string
    {
        return $this->cidadeEndereco;
    }

    /**
     * Set the value of cidadeEndereco
     */ 
    public function setCidadeEndereco($cidadeEndereco)
    {
        $this->cidadeEndereco = $cidadeEndereco;
    }

    /**
     * Get the value of ufEndereco
     */ 
    public function getUfEndereco(): string
    {
        return $this->ufEndereco;
    }

    /**
     * Set the value of ufEndereco
     */ 
    public function setUfEndereco($ufEndereco)
    {
        $this->ufEndereco = $ufEndereco;
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
    public function setLocador($locador)
    {
        $this->locador = $locador;
    }

    public function __toString(): string
    {
        return 'Imóvel: ' . $this->getId() . " - " . 'Locador: ' . $this->getLocador()->getNome() . " - " . 
            $this->getBairroEndereco() . " - " . $this->getCidadeEndereco() . "/" . $this->getUfEndereco();
    }
}