<?php

namespace App\Models;

class Person
{
    private int $id;
    private string $name;
    private string $surname;
    private string $code;
    private ?int $age;
    private ?string $address;
    private ?string $description;

    public function __construct(
        string $name,
        string $surname,
        string $code,
        int $age = null,
        string $address = null,
        string $description = null)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->code = $code;
        $this->description = $description;
        $this->age = $age;
        $this->address = $address;
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

    public function age(): ?int
    {
        return $this->age;
    }

    public function address(): ?string
    {
        return $this->address;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}