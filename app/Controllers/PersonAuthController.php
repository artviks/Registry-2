<?php


namespace App\Controllers;


use App\Services\PersonServices\PersonAuthService;
use Twig\Environment;

class PersonAuthController
{
    private PersonAuthService $service;
    private Environment $twig;

    public function __construct(PersonAuthService $service, Environment $twig)
    {
        $this->service = $service;
        $this->twig = $twig;
    }


    public function login(): void
    {
        $this->twig->display('login.view.twig', [
            'person' => $this->service->login($_GET['code']),
            'error' => $this->service->error(),
        ]);
    }

    public function profile(): void
    {
        $this->twig->display('profile.view.twig', [
            'person' => $this->service->findPerson($_SESSION['auth_id']),
        ]);
    }

    public function logOut(): void
    {
        session_destroy();
        header('Location:/');
    }
}