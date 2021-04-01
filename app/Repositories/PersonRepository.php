<?php

namespace App\Repositories;

use App\Models\Person;
use App\Models\PersonCollection;

interface PersonRepository
{
    public function selectAll(): PersonCollection;

    public function add(Person $person): void;

    public function findPersonBy(string $condition): PersonCollection;

    public function findPersonById(int $id): Person;

    public function update(int $id, int $age, string $address, string $description): void;

}