<?php

namespace Deg540\MochilaAventura\Test;

use PHPUnit\Framework\TestCase;
use Deg540\MochilaAventura\Mochila;
class MochilaTest extends TestCase
{
    /**
     * @test
     */
    public function testInicializarMochilaVacia():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar();

        $this->assertEquals("", $respuesta);
    }

    /**
     * @test
     */
    public function testGuardarObjetoMochila():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar("guardar cantimplora 1");

        $this->assertEquals("1", $respuesta);
    }
}