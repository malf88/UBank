<?php


namespace Ubank;


use Carbon\Carbon;
use Ubank\Exception\UbankException;
use Ubank\Servicos\CDI;

class UbankCDB
{
    public function calcularValorAtualCDBComCDI($valor,Carbon $dataInicio,Carbon $dataFinal = null,$taxa = 100){
        $dataFinal = $dataFinal == null ? Carbon::now() : $dataFinal;

        $dias = $dataFinal->diff($dataInicio);
        $taxaCDI = ($this->getTaxaMediaPeriodo($dataInicio, $dataFinal)/366);

        $taxaCDI = ($taxaCDI * $taxa)/100;
        //echo $dias->days;
        $ubank = new UbankJurosSimples(0, $valor, $taxaCDI, $dias->days);
        $valorFinal = $ubank->calcularJuros();
        return $valor+$valorFinal;
    }

    public function getTaxaMediaPeriodo(Carbon $dataInicio, Carbon $dataTermino){
        $cdi = new CDI();
        $contDia = 1;
        $taxaCDI = 0;
        //$dataInicio->addDay();
        while($dataInicio->lessThan($dataTermino)){
            try{
                $taxaCDI += $cdi->getTaxaPorData($dataInicio);
                $dataInicio->addDay();
                $contDia++;
            }catch (UbankException $e){
                $dataInicio->addDay();
            }
        }
        return $taxaCDI / $contDia;
    }

    public function calcularValorAtualCDBPrefixado($valor,$taxa,Carbon $dataInicio,Carbon $dataFinal = null){
        $dataFinal = $dataFinal == null ? Carbon::now() : $dataFinal;
        $taxa = ($taxa)/365;
        $dias = $dataFinal->diff($dataInicio);

        $ubank = new UbankJurosSimples(0, $valor, $taxa, $dias->days);
        $valorFinal = $ubank->calcularJuros();
        return $valor+$valorFinal;
    }
    public function calcularValorFinalCDBPrefixado($valor,$taxa,Carbon $dataInicio,Carbon $dataFinal = null){
        $dataFinal = $dataFinal == null ? Carbon::now() : $dataFinal;
        $taxa = $taxa/365;
        $dias = $dataFinal->diff($dataInicio)->days;

        $ubank = new UbankJurosCompostos(0,$valor,$taxa,$dias);
        return $ubank->calcularMontante();

    }
}