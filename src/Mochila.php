<?php

namespace Deg540\MochilaAventura;

class Mochila
{

    private array $mochila;

    private const string ACCION_GUARDAR = "guardar";
    public function __construct()
    {
        $this->mochila = [];
    }

    public function ejecutar(string $accion):string{
        [$accion, $objeto, $cantidad] = $this->obtenerParametros($accion);
        if($accion == self::ACCION_GUARDAR){
            $this->guardar($objeto, $cantidad);
        }
        return implode(" ", $this->mochila);
    }

    public function obtenerParametros(string $accion):array{
        $parametros = explode(" ", $accion);
        return [$parametros[0],$parametros[1],$parametros[2]];
    }

    public function guardar(string $objeto, string $cantidad):void{
        $this->mochila[$objeto] = $cantidad;
    }
}