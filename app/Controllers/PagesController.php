<?php

namespace App\Controllers;

class PagesController
{
    public function home(): void
    {
        require __DIR__ . './../../public/Views/index.view.php';
    }
}