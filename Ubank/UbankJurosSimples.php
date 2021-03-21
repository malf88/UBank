<?php


namespace Ubank;


class UbankJurosSimples
{
    private $juros;
    private $capital;
    private $taxa;
    private $tempo;

    public function __construct($juros,$capital,$taxa,$tempo){
        $this->juros = $juros;
        $this->capital = $capital;
        $this->taxa = $taxa/100;
        $this->tempo = $tempo;
    }

    public function calcularJuros(){
        $this->juros = $this->capital * $this->taxa * $this->tempo;

        return $this->juros;
    }
    public function calcularValorTotal(){
        $calJuros = $this->calcularJuros();
        return $this->capital + $calJuros;
    }

}