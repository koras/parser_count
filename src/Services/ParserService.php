<?php

namespace App\Services;


use App\Store\CurlStore;



class ParserService
{

    private $store;

    public function __construct() {
       $this->store =new CurlStore();
    }

    public function execute($query){
        // получаем данные через CURL

        if(isset($query['url'])){
            $url = $query['url'];
            // реализует интерфейс StoreInterface, если вдруг мы захотим переделать под file_get_contents или что-то другое
            $html =  $this->store->executeGetContent($url);
            // получаем количество тэгов
            return $this-> prepareDataArray($html);
        }else{
            echo 'необходимо отправить параметры методом get или post с ключём url <br>';
            echo 'example : parser?url=lenta.ru';
        }
    }

    /**
     * @param $query
     * @return void
     */
    private function prepareDataArray($html){
        $result = [];
        $resultData = [];
        $pattern = '/<\s*([a-zA-Z0-9]+)(?:\s|>)/';
        preg_match_all($pattern, $html, $matches);
        if($matches[1]){
            foreach ($matches[1] as $tag) {

                $resultData[$tag][] = true;
                //   echo $tag . '<br>';
            }
            foreach ($resultData as $key => $tag) {
                $result[$key] = count($tag);
            }
        }
        return $result;
    }


}