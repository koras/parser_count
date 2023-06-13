<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ .'/vendor/autoload.php';


use App\Services\ParserServiceInterface;
use App\Services\ParserService;

// регистрируем зависимости, чтоб свой провайдер как в фреймворке не писать

#$container = new Container();
$container = new App\Config\Container();

$container->set(App\Store\StoreInterface::class, function() {
    return new App\Store\CurlStore();
});
$container->set(ParserServiceInterface::class, function() {
    return new ParserService(new App\Store\CurlStore());
});


// точка входа
use App\Routes\Web;
$router = new Web();
$router->request();
