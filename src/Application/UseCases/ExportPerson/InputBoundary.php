<?php

declare(strict_types = 1);

namespace App\Application\UseCases\ExportPerson;

final class InputBoundary
{
    private string $cpf;

    public function __construct(string $cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCPF(): string
    {
        return $this->cpf;
    }
}