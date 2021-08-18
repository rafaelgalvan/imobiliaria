<?php

namespace App\Model\Entidades;

class Locador
{
    private int $id;
    private string $nome;
    private string $email;
    private string $telefone;
    private int $diaRepasse;

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
     * Get the value of nome
     */ 
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */ 
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Get the value of telefone
     */ 
    public function getTelefone(): string
    {
        return $this->telefone;
    }
    
    /**
     * Set the value of telefone
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * Get the value of dia_repasse
     */ 
    public function getDiaRepasse(): int
    {
        return $this->diaRepasse;
    }

    /**
     * Set the value of dia_repasse
     */ 
    public function setDiaRepasse($diaRepasse)
    {
        $this->diaRepasse = $diaRepasse;
    }
}