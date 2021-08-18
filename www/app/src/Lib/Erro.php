<?php

namespace App\Lib;

class Erro
{
    private string $message;
    private int $code;

    public function render(): void
    {
        $varMessage = $this->message;

        require_once PATH . '/View/layouts/header.php';
        
        if(file_exists(PATH . "/View/error/".$this->code.".php")){
            require_once PATH . "/View/error/".$this->code.".php";
        }else{
            require_once PATH . "/View/error/500.php";
        }

        require_once PATH . '/View/layouts/footer.php';
        exit;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     */ 
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get the value of code
     */ 
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * Set the value of code
     */ 
    public function setCode(int $code)
    {
        $this->code = $code;
    }
}