<?php

namespace App\Controllers;


class BaseController
{

    protected $twig;

    public function __construct() {
       $this->configTwig();

    }

    private function configTwig(){
        $loader = new \Twig\Loader\FilesystemLoader('src/view/');
        $this->twig = new \Twig\Environment($loader, [
         //   'cache' => 'cache', // Опционально: путь к папке для кэширования скомпилированных шаблонов
            'debug' => true, // Опционально: включение режима отладки Twig
        ]);
    }

}