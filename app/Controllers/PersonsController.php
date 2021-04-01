<?php

namespace App\Controllers;

use App\Models\Person;
use App\Services\PersonService;

class PersonsController
{

    private PersonService $service;

    public function __construct(PersonService $service)
    {
        $this->service = $service;
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

        header('Location:/data');
    }

    public function search(): void
    {
        $persons = $this->service->findPersonBy($_GET['condition']);

        require __DIR__ . './../../public/Views/search.view.php';
    }

    public function edit(): void
    {
        $person = $this->service->findPersonById($_GET['id']);

        require __DIR__ . './../../public/Views/edit.view.php';
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