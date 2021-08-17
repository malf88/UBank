<?php
include 'vendor/autoload.php';

$cdi = new \Ubank\Servicos\CDI();
//$cdi->updateMedias();
$ubankCDB = new \Ubank\UbankCDB();
$dataInicial = new \Carbon\Carbon('2020-11-12');
$dataFinal = new \Carbon\Carbon('2021-08-16');

//var_dump($ubankCDB->getTaxaMediaPeriodo($dataInicial,$dataFinal));
var_dump(round($ubankCDB->calcularValorAtualCDBComCDI(5000,$dataInicial,$dataFinal,102),2));
#var_dump(round($ubankCDB->calcularValorAtualCDBComCDI(625,$dataInicial,null),2));
#var_dump(round($ubankCDB->calcularValorAtualCDBPrefixado(625,4.15,$dataInicial,$dataFinal),2));

#var_dump(round($ubankCDB->calcularValorFinalCDBPrefixado(1000,4.15,$dataInicial,$dataFinal),2));