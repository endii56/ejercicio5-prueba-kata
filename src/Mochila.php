<?php

namespace Deg540\MochilaAventura;

class Mochila
{

    private array $mochila;

    private const string ACCION_GUARDAR = "guardar";
    private const string ACCION_USAR = "usar";

    private const string MENSAJE_ERROR_NUMERO_GUARDAR = "La cantidad debe ser un numero positivo";
    private const string MENSAJE_ERROR_NUMERO_NO_ENTERO = "La cantidad del objeto debe ser un numero entero";


    public function __construct()
    {
        $this->mochila = [];
    }

    public function ejecutar(string $accion):string{
        [$accion, $objeto, $cantidad] = $this->obtenerParametros($accion);
        if($accion == self::ACCION_GUARDAR){
            return $this->guardar($objeto, $cantidad);
        }
        if(!array_key_exists($accion, $this->mochila)){
            return "El objeto seleccionado no existe";
        }
        if($accion === self::ACCION_USAR){
            $this->usar($objeto);
        }
        return $this->contenidoMochila();
    }

    public function obtenerParametros(string $accion):array{
        $parametros = explode(" ", $accion);
        $cantidad = !isset($parametros[2]) ? "1" : $parametros[2];
        return [strtolower($parametros[0]),strtolower($parametros[1]),$cantidad];
    }

    public function contenidoMochila():string{
        $contenidoMochila = [];
        foreach($this->mochila as $objeto => $cantidad){
            $contenidoMochila[] = "$objeto x$cantidad";
        }
        return implode(", ", $contenidoMochila);
    }

    public function guardar(string $objeto, string $cantidad):string{
        $cantidadEntera = filter_var($cantidad, FILTER_VALIDATE_INT);
        if($cantidadEntera === false){
            return self::MENSAJE_ERROR_NUMERO_NO_ENTERO;
        }
        if($cantidad <= 0){
            return self::MENSAJE_ERROR_NUMERO_GUARDAR;
        }
        if(array_key_exists($objeto, $this->mochila)){
            $this->mochila[$objeto] += (int)$cantidad;
            return $this->contenidoMochila();
        }
        $this->mochila[$objeto] = (int)$cantidad;
        return $this->contenidoMochila();
    }

    public function usar(string $objeto):void{
        $this->mochila[$objeto] -= 1;
        if($this->mochila[$objeto] === 0){
            unset($this->mochila[$objeto]);
        }
    }
}