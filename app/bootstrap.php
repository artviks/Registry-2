<?php

use App\Controllers\PagesController;
use App\Controllers\PersonsController;
use App\Repositories\Database\MySQLPersonRepository;
use App\Repositories\Database\Connection;
use App\Services\PersonService;

$container = new \League\Container\Container();

$container->add('config', require __DIR__ . './../config.php');
$container->add('connection', Connection::make($container->get('config')['database']));
$container->add('database', MySQLPersonRepository::class)
    ->addArgument('connection');
$container->add('service', PersonService::class)
    ->addArgument('database');
$container->add(PersonsController::class, PersonsController::class)
    ->addArgument('service');

$container->add(PagesController::class, PagesController::class);

return $container;

