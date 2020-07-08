<?php

define('ROOTPATH', __DIR__);

require __DIR__ . '/App/App.php';

session_start();

App\App::init();
App\App::$core->launch();