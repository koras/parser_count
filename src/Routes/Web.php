<?php


namespace App\Routes;

use App\Controllers\ParserController;

class Web
{
    /**
     * Можно было сделать что-то вроде ларика или даже подтянуть в зависимостях, но лень
     * @return void
     */
    public function request()
    {
        $controllerName = $this->getControllerName();
        $method = $this->getMethod();
        $query = $this->getQuery();
        $this->$method($controllerName, $query);
    }

    /**
     * Вызываем метод GET
     * @param $controllerName
     * @param $query
     * @return void
     */
    private function getRequest($controllerName, $query)
    {

        $classNameController = 'App\\Controllers\\' . $controllerName;
        $controller = new  $classNameController;
        $controller->index($query);
    }
    /**
     * Вызываем метод POST
     * @param $controllerName
     * @param $query
     * @return void
     */
    private function postRequest($controllerName, $query)
    {
        $classNameController = 'App\\Controllers\\' . $controllerName;
        $controller = new  $classNameController;
        $controller->index($query);
    }

    /**
     * Получаем название контролёра
     * @return string|null
     */
    private function getControllerName()
    {
        $urlName = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        return ($urlName != "") ? ucfirst(strtolower($urlName)) . "Controller" : "ParserController";
    }

    /**
     * Получаем название метода post или get
     * @return string|null
     */
    private function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']) . "Request";
    }

    /**
     * Получаем переданные параметры
     * @return string|null
     */
    private function getQuery(): array
    {
        parse_str($_SERVER['QUERY_STRING'], $data);
        return $data;
    }

}