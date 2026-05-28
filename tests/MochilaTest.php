<?php

namespace Deg540\MochilaAventura\Test;

use PHPUnit\Framework\TestCase;
use Deg540\MochilaAventura\Mochila;
class MochilaTest extends TestCase
{
    /**
     * @test
     */
    public function testHolaMundo():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->holaMundo();

        $this->assertEquals("Hola mundo!", $respuesta);
    }

    /**
     * @test
     */
    public function testInicializarMochilaVacia():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar();

        $this->assertEquals("", $respuesta);
    }
}