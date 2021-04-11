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

    public function getOtp(): void
    {
        $this->twig->display('index.view.twig', [
            'otp' => $this->service->saveOtp($_GET['code'])
        ]);
    }


    public function logIn(): void
    {
        $this->service->checkOtp($_POST['code'], $_POST['otp']);

        header('Location:/');
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