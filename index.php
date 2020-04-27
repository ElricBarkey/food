<?php

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the auto load file
require_once ("vendor/autoload.php");

//instantiate the F3 Base class
$f3 = Base::instance();

//default route
$f3->route('GET /', function()
{
    $view = new Template();
    echo $view->render('views/home.html');
});

//breakfast route
$f3->route('GET /breakfast', function()
{
    $view = new Template();
    echo $view->render('views/bfast.html');
});

//run f3
$f3->run();

