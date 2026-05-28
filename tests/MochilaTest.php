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

    /**
     * @test
     */
    public function testGuardarMasDeUnObjetoMochila():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("guardar cantimplora 1");
        $respuesta = $mochila->ejecutar("guardar cuerda 2");

        $this->assertEquals("1 2", $respuesta);
    }

    /**
     * @test
     */
    public function testDevolverObjetosCorrectamente():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("guardar cantimplora 1");
        $respuesta = $mochila->ejecutar("guardar cuerda 2");

        $this->assertEquals("cantimplora x1, cuerda x2", $respuesta);
    }
}