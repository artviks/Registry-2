<?php

namespace App\Controllers;

use App\Services\PersonService;

class PagesController
{
    private PersonService $service;

    public function __construct(PersonService $service)
    {
        $this->service = $service;
    }

    public function home(): void
    {
        require __DIR__ . './../../public/Views/index.view.php';
    }

    public function data(): void
    {
        $persons = $this->service->selectAll();

        require __DIR__ . './../../public/Views/data.view.php';
    }

    public function add(): void
    {
        require __DIR__ . './../../public/Views/addData.view.php';
    }

    public function search(): void
    {
        require __DIR__ . './../../public/Views/search.view.php';
    }

}