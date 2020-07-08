<?php


namespace App;


class Router
{

    public function resolve()
    {
        $result = [];

        if (($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false) {
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        } else {
            $route = $_SERVER['REQUEST_URI'];
        }
        $route = explode('/', $route);

        array_shift($route);
        $result[0] = array_shift($route);
        $result[1] = array_shift($route);
        $result[2] = $route;

        return $result;
    }

}