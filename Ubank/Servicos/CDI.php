<?php


namespace Ubank\Servicos;


use Carbon\Carbon;
use FtpClient\FtpClient;
use GuzzleHttp\Client;
use Ubank\Exception\UbankException;

class CDI
{
    const URL_API = 'ftp.cetip.com.br';
    private function getConexao(){
        $cliente = new FtpClient();
        $cliente->connect(self::URL_API);
        $cliente->login('anonymous','');
        $cliente->pasv(true);
        return $cliente;
    }
    public function updateMedias(){
        $cliente = $this->getConexao();
        $cliente->getAll('MediaCDI/', getcwd().'/tmp');
    }
    public function getTaxaPorData(Carbon $data){


        $file = getcwd().'/tmp/'.$data->format('Ymd').'.txt';
        if($data->format('w') == 0 || $data->format('w') == 6){
            throw new UbankException('Não existe taxa para finais de semana.');
        }
        if(!file_exists($file)){
            throw new UbankException('Arquivo ainda não existe');
        }
        chmod($file,0777);
        $taxa = file_get_contents($file);
        $taxa = (int) $taxa;
        return ($taxa /= 100);


    }


}