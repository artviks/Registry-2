<?php

namespace Tests\Unit;

use App\Models\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    public function testPerson(): void
    {
        $person = new Person(
            'A',
            'B',
            '112233-12345',
            30,
            'Valka',
            'Cool'
        );

        self::assertEquals('A', $person->name());
        self::assertEquals('B', $person->surname());
        self::assertEquals('112233-12345', $person->code());
        self::assertEquals(30, $person->age());
        self::assertEquals('Valka', $person->address());
        self::assertEquals('Cool', $person->description());
    }
}