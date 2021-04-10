<?php

namespace App\Controllers;

use App\Services\PersonServices\PersonService;
use Twig\Environment;

class PagesController
{
    private PersonService $service;
    private Environment $twig;

    public function __construct(PersonService $service, Environment $twig)
    {
        $this->service = $service;
        $this->twig = $twig;
    }

    public function home(): void
    {
        $this->twig->display('index.view.twig');
    }

    public function data(): void
    {
        $this->twig->display('data.view.twig', [
            'persons' => $this->service->selectAll()->collection()
        ]);
    }

    public function add(): void
    {
        $this->twig->display('addData.view.twig');
    }

    public function search(): void
    {
        $this->twig->display('search.view.twig');
    }
}