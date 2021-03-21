<?php
use Ubank\UbankJurosSimples;
use PHPUnit\Framework\TestCase;
class UbankJurosSimplesTest extends TestCase
{
    public function testDeveCalcularJurosCorretamente(){
        $ubankJurosSimples = new UbankJurosSimples(null,1000,2,60);
        $this->assertEquals(1200,$ubankJurosSimples->calcularJuros());
    }


    public function testDeveCalcularValorTotalCorretamente(){
        $ubankJurosSimples = new UbankJurosSimples(null,1000,2,60);
        $this->assertEquals(2200,$ubankJurosSimples->calcularValorTotal());
    }
}