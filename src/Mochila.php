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
        if((int)$cantidad < 0){
            return "La cantidad debe ser un numero positivo";
        }
        if($accion == self::ACCION_GUARDAR){
            $this->guardar($objeto, $cantidad);
        }
        return $this->contenidoMochila();
    }

    public function obtenerParametros(string $accion):array{
        $parametros = explode(" ", $accion);
        $cantidad = !isset($parametros[2]) ? "1" : $parametros[2];
        return [$parametros[0],$parametros[1],$cantidad];
    }

    public function contenidoMochila():string{
        $contenidoMochila = [];
        foreach($this->mochila as $objeto => $cantidad){
            $contenidoMochila[] = "$objeto x$cantidad";
        }
        return implode(", ", $contenidoMochila);
    }

    public function guardar(string $objeto, string $cantidad):void{
        $this->mochila[$objeto] = $cantidad;
    }
}