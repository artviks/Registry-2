<?php

namespace App\Services\PersonServices;

use App\Models\Person;
use App\Models\PersonCollection;
use App\Repositories\PersonRepository;

class PersonService
{
    private PersonRepository $storage;

    public function __construct(PersonRepository $storage)
    {
        $this->storage = $storage;
    }

    public function selectAll(): PersonCollection
    {
        return $this->storage->selectAll();
    }

    public function add(Person $person): void
    {
        $this->storage->add($person);
    }

    public function findPersonBy(string $condition): ?PersonCollection
    {
        return $this->storage->findPersonBy($condition);
    }

    public function findPersonById(int $id): Person
    {
        return $this->storage->findPersonById($id);
    }

    public function update(int $id, int $age, string $address, string $description): void
    {
        $this->storage->update($id, $age, $address, $description);
    }

}