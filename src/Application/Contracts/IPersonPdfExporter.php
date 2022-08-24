<?php

declare(strict_types = 1);

namespace App\Application\Contracts;

use App\Domain\Entities\Person;

interface IPersonPdfExporter
{
    public function generate(Person $person): string;
}