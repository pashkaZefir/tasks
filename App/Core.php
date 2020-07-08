<?php


namespace App;


use App\App;
use App\InvalidRouteException;

class Core
{
    public $defaultControllerName = 'Home';

    public $defaultActionName = 'index';

    public function launch()
    {
        list($controllerName, $actionName) = App::$router->resolve();
        echo $this->launchAction($controllerName, $actionName);
    }

    public function launchAction($controllerName, $actionName)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $params = (!!$_POST) ? array_merge($_POST, $_GET) : $_GET;

        $controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName);
        if (!file_exists(ROOTPATH . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php')) {
            throw new InvalidRouteException();
        }
        require_once ROOTPATH . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $controllerName . '.php';
        if (!class_exists("\\Controllers\\" . ucfirst($controllerName))) {
            throw new InvalidRouteException();
        }
        $controllerName = "\\Controllers\\" . ucfirst($controllerName);
        $controller = new $controllerName;
        $actionName = empty($actionName) ? $this->defaultActionName : $actionName;
        if (!method_exists($controller, $actionName)) {
            throw new InvalidRouteException();
        }
        return $controller->$actionName($params, $method);
    }
}