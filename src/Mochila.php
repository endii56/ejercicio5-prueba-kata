<?php

namespace Deg540\MochilaAventura;

class Mochila
{

    private array $mochila;

    public function __construct()
    {
        $this->mochila = [];
    }

    public function ejecutar():string{
        if(empty($this->mochila)){
            return "";
        }
        return "la mochila tiene objetos";
    }
}