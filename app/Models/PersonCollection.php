<?php

namespace App\Models;

class PersonCollection
{
    private array $collection;

    public function add(Person $person): void
    {
        $this->collection[] = $person;
    }

    public function collection(): array
    {
        return $this->collection;
    }
}