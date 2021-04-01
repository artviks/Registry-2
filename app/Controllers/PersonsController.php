<?php

namespace App\Controllers;

use App\Models\Person;
use App\Services\PersonService;
use Twig\Environment;

class PersonsController
{

    private PersonService $service;
    private Environment $twig;

    public function __construct(PersonService $service, Environment $twig)
    {
        $this->service = $service;
        $this->twig = $twig;
    }

    public function add(): void
    {
        $this->service->add(
            new Person(
                $_POST['name'],
                $_POST['surname'],
                $_POST['code'],
                $_POST['age'],
                $_POST['address'],
                $_POST['description']
            ));

        header('Location:/add');
    }

    public function search(): void
    {
        $this->twig->display('search.view.twig', [
            'persons' => $this->service->findPersonBy($_GET['condition'])->collection()
        ]);
    }

    public function edit(): void
    {
        $this->twig->display('edit.view.twig', [
            'person' => $this->service->findPersonById($_GET['id'])
        ]);
    }

    public function update(): void
    {
        $this->service->update(
            $_POST ['id'],
            $_POST['age'],
            $_POST['address'],
            $_POST['description']
        );

        header('Location:/data');
    }
}