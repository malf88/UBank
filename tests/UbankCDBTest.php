<?php
use Ubank\UbankCDB;
use PHPUnit\Framework\TestCase;
use Ubank\Servicos\CDI;
class UbankCDBTest extends TestCase
{
    public function testDeveCalcularValorAtualCDBComCDI(){
        $ubankCDB = new UbankCDB();
        $mockCDI = $this->createMock(CDI::class);
        $mockCDI->method('getTaxaPorData')
            ->willReturn('000000440');
        $this->assertEquals(1000.12,round($ubankCDB->calcularValorAtualCDBComCDI(1000,new \Carbon\Carbon('2020-01-02'),new \Carbon\Carbon('2020-01-03'),100),2));
    }
    public function testCalcularValorAtualCDBPrefixado(){
        $ubankCDB = new UbankCDB();

        $this->assertEquals(1000.12,round($ubankCDB->calcularValorAtualCDBPrefixado(1000,4.40,new \Carbon\Carbon('2020-01-02'),new \Carbon\Carbon('2020-01-03')),2));
    }

    public function testCalcularValorFinalCDBPrefixado(){
        $ubankCDB = new UbankCDB();

        $this->assertEquals(1000.12,round($ubankCDB->calcularValorFinalCDBPrefixado(1000,4.40,new \Carbon\Carbon('2020-01-02'),new \Carbon\Carbon('2020-01-03')),2));
    }
}