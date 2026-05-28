<?php

namespace Deg540\MochilaAventura;

class Mochila
{

    private array $mochila;

    private const string ACCION_GUARDAR = "guardar";
    private const string ACCION_USAR = "usar";
    private const string ACCION_VACIAR = "vaciar";

    private const string MENSAJE_ERROR_NUMERO_GUARDAR = "La cantidad debe ser un numero positivo";
    private const string MENSAJE_ERROR_NUMERO_NO_ENTERO = "La cantidad del objeto debe ser un numero entero";
    private const string MENSAJE_ERROR_OBJETO_NO_EXISTE = "El objeto seleccionado no existe";


    public function __construct()
    {
        $this->mochila = [];
    }

    public function ejecutar(string $accion):string{
        [$accion, $objeto, $cantidad] = $this->obtenerParametros($accion);
        if($accion == self::ACCION_GUARDAR){
            return $this->guardar($objeto, $cantidad);
        }
        if($accion === self::ACCION_USAR){
            return $this->usar($objeto);
        }
        if($accion === self::ACCION_VACIAR){
            $this->vaciar();
        }
        return $this->contenidoMochila();
    }

    private function obtenerParametros(string $accion):array{
        $parametros = explode(" ", $accion);
        $cantidad = !isset($parametros[2]) ? "1" : $parametros[2];
        return [strtolower($parametros[0]),strtolower($parametros[1]),$cantidad];
    }

    private function contenidoMochila():string{
        $contenidoMochila = [];
        ksort($this->mochila);
        foreach($this->mochila as $objeto => $cantidad){
            $contenidoMochila[] = "$objeto x$cantidad";
        }
        return implode(", ", $contenidoMochila);
    }

    private function guardar(string $objeto, string $cantidad):string{
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

    private function usar(string $objeto):string{
        if(!array_key_exists($objeto, $this->mochila)){
            return self::MENSAJE_ERROR_OBJETO_NO_EXISTE;
        }
        $this->mochila[$objeto] -= 1;
        if($this->mochila[$objeto] === 0){
            unset($this->mochila[$objeto]);
        }
        return $this->contenidoMochila();
    }

    private function vaciar():void
    {
        $this->mochila = [];
    }
}