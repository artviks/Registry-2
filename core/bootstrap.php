<?php

use App\Controllers\PagesController;
use App\Controllers\PersonAuthController;
use App\Controllers\PersonsController;
use App\Repositories\Database\MySQLPersonRepository;
use App\Repositories\Database\Connection;
use App\Repositories\Database\MySQLPersonTokenRepository;
use App\Services\PersonServices\PersonAuthService;
use App\Services\PersonServices\PersonService;
use League\Container\Container;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

//twig setup
$twig = new Environment(new FilesystemLoader('./../public/Views'));
$twig->addGlobal('loggedIn', isset($_SESSION['auth_id']));

$container = new Container();

$container->add('twig', $twig);

//controller dependencies
$container->add('config', require __DIR__ . './../config.php');
$container->add('connection', Connection::make($container->get('config')['database']));
$container->add('database', MySQLPersonRepository::class)
    ->addArgument('connection');
$container->add('service', PersonService::class)
    ->addArgument('database');
$container->add('tokenData', MySQLPersonTokenRepository::class)
    ->addArgument('connection');
$container->add('authService', PersonAuthService::class)
    ->addArguments(['database', 'tokenData']);

$container->add(PersonsController::class, PersonsController::class)
    ->addArguments(['service', 'twig']);
$container->add(PagesController::class, PagesController::class)
    ->addArguments(['service', 'twig']);
$container->add(PersonAuthController::class, PersonAuthController::class)
    ->addArguments(['authService', 'twig']);

return $container;