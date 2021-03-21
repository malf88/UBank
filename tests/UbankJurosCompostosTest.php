<?php

use PHPUnit\Framework\TestCase;
use Ubank\UbankJurosCompostos;
class UbankJurosCompostosTest extends TestCase
{
    public function testDeveCalcularMontante(){
        $ubankJurosCompostos = new UbankJurosCompostos(null,1000,0.16,2);

        $this->assertEquals(1003.20,round($ubankJurosCompostos->calcularMontante(),2));
    }

    public function testDeveCalcularPrincipal(){
        $ubankJurosCompostos = new UbankJurosCompostos(1003.20,null,0.16,2);

        $this->assertEquals(1000,round($ubankJurosCompostos->calcularPrincipal(),2));
    }
}