<?php


namespace Controllers;


use App\App;
use Config\Config;

class Base
{
    public static $layoutName = 'Default';

    public function redirection($url)
    {
        header('Location: ' . $url);
        return true;
    }

    public static function alert($message, $class)
    {
        return "<div class=\"alert alert-$class m-2\" role=\"alert\">$message</div>";
    }

    public static function isLoggedIn()
    {
        $hash = md5(Config::$adminLogin . '|' . Config::$adminPassword);
        if (isset($_SESSION['user']) && $_SESSION['user'] === $hash) {
            return true;
        }

        return false;
    }

    public function renderLayout($body, $params)
    {
        extract($params);
        ob_start();
        require ROOTPATH . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Layouts' . DIRECTORY_SEPARATOR . static::$layoutName . ".php";
        return ob_get_clean();

    }

    public function render($viewName, array $params = [])
    {

        $viewFile = ROOTPATH . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $viewName . '.php';
        $params['isLogged'] = self::isLoggedIn();
        extract($params);
        ob_start();
        $isLogged = self::isLoggedIn();
        require $viewFile;
        $body = ob_get_clean();
        ob_end_clean();
        return $this->renderLayout($body, $params);

    }

    public function renderPartial($viewName, array $params = [])
    {

        $viewFile = ROOTPATH . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . 'Partials' . DIRECTORY_SEPARATOR . $viewName . '.php';
        extract($params);
        ob_start();
        require $viewFile;
        $body = ob_get_clean();
        return $body;

    }
}