<?php

declare(strict_types = 1);

namespace App\Application\UseCases\ExportPerson;

final class OutputBoundary
{
    private string $fullFilename;

    public function __construct(string $fullFilename)
    {
        $this->fullFilename = $fullFilename;
    }
}