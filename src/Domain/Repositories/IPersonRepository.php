<?php

declare(strict_types = 1);

namespace App\Domain\Repositories;

use App\Domain\Entities\Person;
use App\Domain\ValueObjects\CPF;

interface IPersonRepository
{
    public function getByCpf(CPF $cpf): Person;
}