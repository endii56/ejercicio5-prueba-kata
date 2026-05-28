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

        $respuesta = $mochila->ejecutar("");

        $this->assertEquals("", $respuesta);
    }

    /**
     * @test
     */
    public function testGuardarObjetoMochila():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar("guardar cantimplora 1");

        $this->assertEquals("cantimplora x1", $respuesta);
    }

    /**
     * @test
     */
    public function testGuardarMasDeUnObjetoMochila():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("guardar cantimplora 1");
        $respuesta = $mochila->ejecutar("guardar cuerda 2");

        $this->assertEquals("cantimplora x1, cuerda x2", $respuesta);
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

    /**
     * @test
     */
    public function testNoIngresarCantidadDeObjeto():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar("guardar cantimplora");

        $this->assertEquals("cantimplora x1", $respuesta);
    }

    /**
     * @test
     */
    public function testIngresarUnNumeroNegativo():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar("guardar cantimplora -3");

        $this->assertEquals("La cantidad debe ser un numero positivo", $respuesta);
    }

    /**
     * @test
     */
    public function testGuardarObjetoCantidadCero():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar("guardar cantimplora 0");

        $this->assertEquals("La cantidad debe ser un numero positivo", $respuesta);
    }

    /**
     * @test
     */
    public function testGuardarUnObjetoConCantidadQueNoEsUnEntero():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar("guardar cantimplora 3.1");

        $this->assertEquals("La cantidad del objeto debe ser un numero entero", $respuesta);
    }

    /**
     * @test
     */
    public function testGuardarUnObjetoConCantidadNoNumerica():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar("guardar cantimplora zapatillla");

        $this->assertEquals("La cantidad del objeto debe ser un numero entero", $respuesta);
    }

    /**
     * @test
     */
    public function testIntroducirElComandoGuardarEnMayusculasDebeTratarseIgulQueEnMinusculas():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar("GuarDAR cantimplora 4");

        $this->assertEquals("cantimplora x4", $respuesta);
    }

    /**
     * @test
     */
    public function testAlmacenarObjetosEnMinusculas():void
    {
        $mochila = new Mochila();

        $respuesta = $mochila->ejecutar("guardar CantiMPloRA 6");

        $this->assertEquals("cantimplora x6", $respuesta);
    }

    /**
     * @test
     */
    public function testAlmacenarUnObjetoQueYaExiste():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("guardar cantimplora 3");
        $respuesta = $mochila->ejecutar("guardar cantimplora 4");

        $this->assertEquals("cantimplora x7", $respuesta);

    }

    /**
     * @test
     */
    public function testDespuesDeErrorSePuedeAlmacenar():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("guardar cantimplora error");
        $respuesta = $mochila->ejecutar("guardar guantes 3");

        $this->assertEquals("guantes x3", $respuesta);
    }

    /**
     * @test
     */
    public function testUsarObjetoDeLaMochila():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("guardar cantimplora 3");
        $respuesta = $mochila->ejecutar("usar cantimplora");

        $this->assertEquals("cantimplora x2", $respuesta);
    }

    /**
     * @test
     */
    public function testCuandoUnObjetoLlegaA0SeDebeEliminarDeLaMochila():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("guardar cantimplora 1");
        $respuesta = $mochila->ejecutar("usar cantimplora");

        $this->assertEquals("", $respuesta);
    }

    /**
     * @test
     */
    public function testUsarUnObjetoNoExistente():void
    {
        $mochila = new Mochila();

        $respueta = $mochila->ejecutar("usar cantimplora");

        $this->assertEquals("El objeto seleccionado no existe", $respueta);
    }

    /**
     * @test
     */
    public function testAccionUsarEnMayusculasSeDebeTratarIgualmente():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("guardar cantimplora 3");
        $respuesta = $mochila->ejecutar("UsAR cantimplora");

        $this->assertEquals("cantimplora x2", $respuesta);
    }

    /**
     * @test
     */
    public function testDespuesDeErrorAlUsarSePuedeAñadirObjeto():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("usar cantimplora");
        $respuesta = $mochila->ejecutar("guardar cantimplora");

        $this->assertEquals("cantimplora x1", $respuesta);
    }

    /**
     * @test
     */
    public function testVaciarMochilaConContenido():void
    {
        $mochila = new Mochila();

        $mochila->ejecutar("guardar cantimplora 2");
        $respuesta = $mochila->ejecutar("vaciar");

        $this->assertEquals("", $respuesta);
    }
}