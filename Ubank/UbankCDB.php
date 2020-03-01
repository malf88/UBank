<?php


namespace Ubank;


use Carbon\Carbon;
use Ubank\Servicos\CDI;

class UbankCDB
{
    public function calcularValorAtualCDBComCDI($valor,Carbon $dataInicio,Carbon $dataFinal = null,$taxa = 100){
        $dataFinal = $dataFinal == null ? Carbon::now() : $dataFinal;
        $taxa = $taxa / 100;
        $cdi = new CDI();

        $dias = $dataFinal->diff($dataInicio);
        if($dataFinal->format('w') == 6){
            $dataFinal->modify('-1 day');
        }elseif($dataFinal->format('w') == 0){
            $dataFinal->modify('-2 day');
        }

        $taxaCDI = ($cdi->getTaxaPorData($dataFinal) / 365);

        $taxaCDI = $taxaCDI * $taxa;

        $ubank = new UbankJurosSimples(0, $valor, $taxaCDI, $dias->days);
        $valorFinal = $ubank->calcularJuros();
        return $valor+$valorFinal;
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
        $valorFinal = $ubank->calcularMontante();
        return $valorFinal;
    }
}