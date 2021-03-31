<?php

namespace App\Services;

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

    public function findPersonBy(string $condition): PersonCollection
    {
        return $this->storage->findPersonBy($condition);
    }

    public function updateDescription(string $description, int $id): void
    {
        $this->storage->updateDescription($description, $id);
    }

    public function updateAge(int $age, int $id): void
    {
        $this->storage->updateAge($age, $id);
    }

    public function updateAddress(string $address, int $id): void
    {
        $this->storage->updateAddress($address, $id);
    }

}