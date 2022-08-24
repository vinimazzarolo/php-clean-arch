<?php

declare(strict_types = 1);

namespace App\Application\UseCases\ExportPerson;

final class InputBoundary
{
    private string $cpf;
    private string $pdfFilename;
    private string $pdfPath;

    public function __construct(string $cpf, string $pdfFilename, string $pdfPath)
    {
        $this->cpf = $cpf;
        $this->pdfFilename = $pdfFilename;
        $this->pdfPath = $pdfPath;
    }

    public function getCPF(): string
    {
        return $this->cpf;
    }

    public function getPdfFilename(): string
    {
        return $this->pdfFilename;
    }

    public function getPdfPath(): string
    {
        return $this->pdfPath;
    }
}