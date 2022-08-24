<?php

declare(strict_types = 1);

namespace App\Application\UseCases\ExportPerson;

final class OutputBoundary
{
    private string $name;
    private string $email;
    private string $cpf;
    private string $birthDate;

    public function __construct(array $values)
    {
        $this->name = $values['name'] ?? '';
        $this->email = $values['email'] ?? '';
        $this->cpf = $values['cpf'] ?? '';
        $this->birthDate = $values['birthDate'] ?? '';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCPF(): string
    {
        return $this->cpf;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }
}