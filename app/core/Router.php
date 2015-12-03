<?php

class Router
{
    protected $controller = 'AddressesController';
    protected $method = 'index';

    public function __construct()
    {
        $url = $this->ParseUrl();

        $controller_name = isset($url[0]) ? ucfirst($url[0]) . 'Controller' : $this->controller;
        $controller_path = '../app/controllers/' . $controller_name . '.php';
        unset($url[0]);

        if (file_exists($controller_path)) {
            require_once $controller_path;
        } else {
            Router::error404("Invalid controller");
        }


        $controller = new $controller_name;

        $parameters = $url ? array_values($url) : [];

        if (count($parameters) > 1)
            Router::error404("Too many parameters, 1 expected");

        call_user_func_array([$controller, $this->method], $parameters);
    }

    protected function ParseUrl()
    {
        if (isset($_GET['url']))
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }

    public static function error404($msg)
    {
        header('HTTP/1.1 404 Not Found');
        echo "<h1>404 " . $msg . "</h1>";
        exit();
    }
}