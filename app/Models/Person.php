<?php

namespace App\Models;

class Person
{
    private int $id;
    private string $name;
    private string $surname;
    private string $code;
    private string $description;

    public function __construct(string $name, string $surname, string $code, string $description = '')
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->code = $code;
        $this->description = $description;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): string
    {
        return $this->surname;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}