<?php

class Router
{
    private $routes;

    public function __construct()
    {
        // Получаем массив путей
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    // Метод получения урла запроса
    private function getURI(){
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        // Получаем урл запроса
        $uri = $this->getURI();

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {
            
            // Сравниваем $uriPattern и  $uri
            if (preg_match("~$uriPattern~", $uri)) {
                //Если есть совпадение, определить какой контроллер и action обрабатывает запрос
                $segments = explode('/', $path);

                // CONTROLLER NAME
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
                // ACTION NAME
                $actionName = 'action'.ucfirst(array_shift($segments));

                // Подключить файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создать объект, вызвать метод (т.е. action)
                $controllObject = new $controllerName;
                $result = $controllObject->$actionName();
                if ($result != null) {
                    break;
                }
            }
        }
    }
}
