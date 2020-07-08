<?php


namespace App;


use Throwable;
use App\InvalidRouteException;

class App
{
    public static $router;
    public static $db;
    public static $core;

    public static function init()
    {
        spl_autoload_register(['static', 'loadClass']);
        static::bootstrap();
        set_exception_handler(['App', 'handleException']);
    }

    public static function bootstrap()
    {
        static::$router = new Router();
        static::$core = new Core();
        static::$db = new DB();
    }

    public static function loadClass($className)
    {
        $path = str_replace('\\', '/', ltrim($className, '\\')) . '.php';
        if ($fullPath = stream_resolve_include_path($path)) {
            include_once $fullPath;
        }
    }

    public function handleException(Throwable $e)
    {
        if ($e instanceof InvalidRouteException) {
            echo static::$core->launchAction('Error', 'error404', [$e]);
        } else {
            echo static::$core->launchAction('Error', 'error500', [$e]);
        }
    }
}