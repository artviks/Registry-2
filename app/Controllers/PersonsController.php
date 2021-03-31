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

    public function data(): void
    {
        $persons = $this->service->selectAll();

        require __DIR__ . './../../public/Views/data.view.php';
    }

    public function search(): void
    {
        $persons = $this->service->findPersonBy($_GET['condition']);

        require __DIR__ . './../../public/Views/index.view.php';
    }

    public function add(): void
    {
        $this->service->add(
            new Person(
                $_POST['name'],
                $_POST['surname'],
                $_POST['code'],
                $_POST['description'],
            ));

        header('Location:/data');
    }

    public function updateDescription(): void
    {
        $id = array_key_first($_POST);
        $description = $_POST[$id];
        $this->service->updateDescription($description, $id);

        header('Location:/data');
    }
}