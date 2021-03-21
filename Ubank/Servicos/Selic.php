<?php


namespace Ubank\Servicos;


use Carbon\Carbon;
use GuzzleHttp\Client;

class Selic
{
    const URL_API = 'https://api.bcb.gov.br/dados/serie/bcdata.sgs.11/dados?formato=json';
    private function getConexao(){
        return  new Client();
    }

    public function getTaxaPorData(Carbon $data){
        $data = ($data == null) ? Carbon::now() : $data;

        $cliente = $this->getConexao();
        $result = $cliente->get(self::URL_API . '&dataInicial='.$data->format('d/m/Y').'&dataFinal='.$data->format('d/m/Y'));
        $array =  \GuzzleHttp\json_decode($result->getBody()->getContents());
        return $array[0]->valor;

    }
}