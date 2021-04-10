<?php

use Core\FastRouter;

require "../vendor/autoload.php";

session_start();

$container = require "../core/bootstrap.php";
$routes = require '../core/routes.php';

FastRouter::load($routes, $container);