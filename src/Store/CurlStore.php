<?php

namespace App\Store;


class CurlStore implements StoreInterface
{
    public function executeGetContent($url){
        return $this -> execute($url);
    }

    private function execute($url){

        $headers = array( );

        $ch = curl_init("https://".$url);
     //   curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . '/cookie.txt');
     //  curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . '/cookie.txt');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $html = curl_exec($ch);
        curl_close($ch);

      //  $html= iconv('windows-1251', 'UTF-8', $html);
     //    echo $html;
        return  $html;
    }
}