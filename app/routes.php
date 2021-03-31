<?php

use App\Controllers\PagesController;
use App\Controllers\PersonsController;

return FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r)
{
    $r->addRoute('GET', '/', [PagesController::class, 'home']);

    $r->addRoute('GET', '/data', [PersonsController::class, 'data']);
    $r->addRoute('GET', '/search', [PersonsController::class, 'search']);
    $r->addRoute('POST', '/data', [PersonsController::class, 'add']);
    $r->addRoute('POST', '/description', [PersonsController::class, 'updateDescription']);
});