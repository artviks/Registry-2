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

    public function saveOtp(string $code): ?string
    {
        $person = $this->findPerson($code);

        if ($person === null)
        {
            $this->error = 'Personal code not fond!';
            return null;
        }

        $otp = $this->generate();
        $this->save($person, $otp);

        return $otp;
    }

    public function checkOtp(string $code, string $otp): bool
    {
        if ($this->tokenRepository->getCode($otp) === $code)
        {
            $_SESSION['auth_id'] = $code;
            return true;
        }

        return false;
    }

    public function error(): string
    {
        return $this->error;
    }

    public function findPerson(string $code): ?Person
    {
        if ($this->repository->findPersonBy($code) === null) {
            return null;
        }

        return $this->repository->findPersonBy($code)->collection()[0];
    }

    private function save(Person $person, string $otp): void
    {
        $this->tokenRepository->save($person, $otp);
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