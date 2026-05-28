<?php

namespace Deg540\MochilaAventura;

class Mochila
{

    private array $mochila;

    public function __construct()
    {
        $this->mochila = [];
    }

    public function ejecutar(string $accion):string{
        [$accion, $objeto, $cantidad] = explode(" ", $accion);
        if($accion == "guardar"){
            $this->mochila[$objeto] = $cantidad;
        }
        if(empty($this->mochila)){
            return "";
        }
        return implode(" ", $this->mochila);
    }
}