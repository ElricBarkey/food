<?php
//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//start a session
session_start();


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

//breakfast green eggs and ham route
$f3->route('GET /breakfast/green-eggs', function()
{
    $view = new Template();
    echo $view->render('views/greenEggsAndHam.html');
});

//lunch
$f3->route('GET /lunch', function()
{
    $view = new Template();
    echo $view->render('views/lunch.html');
});

//order form
$f3->route('GET|POST /order', function($f3)
{
    //if the form has been submitted
    if($_SERVER['REQUEST_METHOD'])
    {
        //var_dump($_POST);
        //["food"]=> string(6) "borgur" ["meal"]=> string(5) "lunch"

        //validate data
        $meals = array("breakfast", "lunch", "dinner");

        if ($_POST['food'] == "" || !in_array($_POST['meal'], $meals))
        {
            echo "<h3 class='text-danger'>Please enter a food and select a meal</h3>";
        }

        //Data is valid
        else
        {
            //store the data in the session array
            $_SESSION['food'] = $_POST['food'];
            $_SESSION['meal'] = $_POST['meal'];

            $f3->reroute('summary');
            session_destroy();
        }
    }


    $view = new Template();
    echo $view->render('views/order.html');
});

//summary
$f3->route('GET /summary', function()
{
    //echo "<h1>Thank you for your order</h1>";
    $view = new Template();
    echo $view->render('views/summary.html');
});

//run f3
$f3->run();

