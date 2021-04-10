<?php

namespace App\Repositories;

use App\Models\Person;

interface PersonTokenRepository
{
    public function save(Person $person, string $otp): void;

    public function fetchAdded(string $code): string;
}