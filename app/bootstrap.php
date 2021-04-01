<?php

use App\Controllers\PagesController;
use App\Controllers\PersonsController;
use App\Repositories\Database\MySQLPersonRepository;
use App\Repositories\Database\Connection;
use App\Services\PersonService;
use League\Container\Container;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader('./../public/Views');
$twig = new Environment($loader);


$container = new Container();

$container->add('twig', $twig);

$container->add('config', require __DIR__ . './../config.php');
$container->add('connection', Connection::make($container->get('config')['database']));
$container->add('database', MySQLPersonRepository::class)
    ->addArgument('connection');
$container->add('service', PersonService::class)
    ->addArgument('database');

$container->add(PersonsController::class, PersonsController::class)
    ->addArguments(['service', 'twig']);

$container->add(PagesController::class, PagesController::class)
    ->addArguments(['service', 'twig']);

return $container;

