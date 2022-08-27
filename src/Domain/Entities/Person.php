<?php

declare(strict_types = 1);

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;
use DateTimeInterface;

final class Person
{
    private string $name;
    private Email $email;
    private Cpf $cpf;
    private DateTimeInterface $birthDate;

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getCpf(): Cpf
    {
        return $this->cpf;
    }

    public function getBirthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setName(string $name): Person
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail(Email $email): Person
    {
        $this->email = $email;
        return $this;
    }

    public function setCpf(Cpf $cpf): Person
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function setBirthDate(DateTimeInterface $birthDate): Person
    {
        $this->birthDate = $birthDate;
        return $this;
    }
}