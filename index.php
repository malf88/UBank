<?php
include 'vendor/autoload.php';


$ubankCDB = new \Ubank\UbankCDB();
$dataInicial = new \Carbon\Carbon('2020-02-27');
$dataFinal = new \Carbon\Carbon('2020-04-06');
var_dump(round($ubankCDB->calcularValorAtualCDBComCDI(625,$dataInicial,null),2));
var_dump(round($ubankCDB->calcularValorAtualCDBPrefixado(625,4.15,$dataInicial,$dataFinal),2));

var_dump(round($ubankCDB->calcularValorFinalCDBPrefixado(1000,4.15,$dataInicial,$dataFinal),2));