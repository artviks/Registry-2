<?php

namespace App\Services\PersonServices;

use App\Models\Person;
use App\Repositories\PersonRepository;
use App\Repositories\PersonTokenRepository;
use DateInterval;
use DateTime;
use DateTimeZone;

class PersonAuthService
{
    private const EXPIRES_AFTER = 'PT1H';
    private const OTP_LENGTH = 10;
    private string $error = '';
    private PersonRepository $repository;
    private PersonTokenRepository $tokenRepository;
    private DateInterval $expiryInterval;

    public function __construct(PersonRepository $repository, PersonTokenRepository $tokenRepository)
    {
        $this->repository = $repository;
        $this->tokenRepository = $tokenRepository;
        $this->expiryInterval = new DateInterval(self::EXPIRES_AFTER);
    }

    public function login(string $code): ?Person
    {
        $person = $this->findPerson($code);

        if ($person === null)
        {
            $this->error = 'Personal code not fond!';
            return null;
        }

        $this->save($person);
        $_SESSION['auth_id'] = $code;

        return $person;
    }

    public function isValid(string $code): bool
    {
        $date = new DateTime('now', new DateTimeZone('Europe/Riga'));
        $date->sub($this->expiryInterval);

        return $this->tokenRepository->fetchAdded($code) > $date->format('Y-m-d H:i:s');
    }

    public function error(): string
    {
        return $this->error;
    }


    private function save(Person $person): void
    {
        $this->tokenRepository->save($person, $this->generate());
    }

    public function findPerson(string $code): ?Person
    {
        if ($this->repository->findPersonBy($code) === null) {
            return null;
        }

        return $this->repository->findPersonBy($code)->collection()[0];
    }

    private function generate(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < self::OTP_LENGTH; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}