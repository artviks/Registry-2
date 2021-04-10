<?php

use App\Controllers\PagesController;
use App\Controllers\PersonAuthController;
use App\Controllers\PersonsController;

return FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r)
{
    // PagesController
    $r->addRoute('GET', '/', [PagesController::class, 'home']);
    $r->addRoute('GET', '/add', [PagesController::class, 'add']);
    $r->addRoute('GET', '/data', [PagesController::class, 'data']);
    $r->addRoute('GET', '/search', [PagesController::class, 'search']);

    // PersonController
    $r->addRoute('GET', '/searchPerson', [PersonsController::class, 'search']);
    $r->addRoute('GET', '/edit', [PersonsController::class, 'edit']);

    $r->addRoute('POST', '/add', [PersonsController::class, 'add']);
    $r->addRoute('POST', '/update', [PersonsController::class, 'update']);

    // PersonAuthController
    $r->addRoute('GET', '/login', [PersonAuthController::class, 'login']);
    $r->addRoute('GET', '/profile', [PersonAuthController::class, 'profile']);
    $r->addRoute('GET', '/logOut', [PersonAuthController::class, 'logOut']);
});