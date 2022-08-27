<?php

declare(strict_types = 1);

namespace App\Domain\Repositories;

use App\Domain\Entities\Person;
use App\Domain\ValueObjects\Cpf;

interface IPersonRepository
{
    public function getByCpf(Cpf $cpf): Person;
}