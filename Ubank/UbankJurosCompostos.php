<?php


namespace Ubank;


class UbankJurosCompostos
{
    private $montante;
    private $principal;
    private $taxa;
    private $periodos;
    /**
     * Fórmula
     * $montante = $principal * ((1 + $taxa) ^ $periodos)
     */

    public function __construct($montante,$principal,$taxa,$periodos)
    {
        $this->montante = $montante;
        $this->principal = $principal;
        $this->taxa = ($taxa/100);
        $this->principal = $principal;
        $this->periodos = $periodos;
    }

    public function calcularMontante(){
        $this->montante = $this->principal * pow(1 + $this->taxa,$this->periodos);
        return $this->montante;
    }

    /**
     * 126 = x * ((1+0,01)^24)
     * $principal = ((1 + $taxa) ^ $periodos)/$montante
     * 126 = x * 1,26
     * x/1 = 1,26/126
     *
     * x = 16777216/126
     */
    public function calcularPrincipal(){
        $this->principal = (pow(1+$this->taxa,$this->periodos)) / $this->montante;
        return $this->principal;
    }

    /**
     * @return mixed
     */
    public function getMontante()
    {
        return $this->montante;
    }

    /**
     * @param mixed $montante
     */
    public function setMontante($montante)
    {
        $this->montante = $montante;
    }

    /**
     * @return mixed
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * @param mixed $principal
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;
    }

    /**
     * @return mixed
     */
    public function getTaxa()
    {
        return $this->taxa;
    }

    /**
     * @param mixed $taxa
     */
    public function setTaxa($taxa)
    {
        $this->taxa = $taxa/100;
    }

    /**
     * @return mixed
     */
    public function getPeriodos()
    {
        return $this->periodos;
    }

    /**
     * @param mixed $periodos
     */
    public function setPeriodos($periodos)
    {
        $this->periodos = $periodos;
    }


}