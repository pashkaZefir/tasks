<?php


namespace App;


use Exception;

class InvalidRouteException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Route not found", 404);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}