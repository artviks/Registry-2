<?php

use App\FastRouter;

require "../vendor/autoload.php";

$container = require "../app/bootstrap.php";
$routes = require '../app/routes.php';


FastRouter::load($routes, $container);