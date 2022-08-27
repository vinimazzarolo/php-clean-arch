<?php

declare(strict_types = 1);

namespace App\Application\UseCases\ExportPerson;

use App\Application\Contracts\IPersonPdfExporter;
use App\Application\Contracts\IStorage;
use App\Domain\Repositories\IPersonRepository;
use App\Domain\ValueObjects\Cpf;

final class ExportPerson
{
    private IPersonRepository $repository;
    private IPersonPdfExporter $personPdfExporter;
    private IStorage $storage;

    public function __construct(
        IPersonRepository $repository,
        IPersonPdfExporter $personPdfExporter,
        IStorage $storage
        )
    {
        $this->repository = $repository;
        $this->personPdfExporter = $personPdfExporter;
        $this->storage = $storage;   
    }

    public function handle(InputBoundary $input): OutputBoundary
    {
        $cpf = new Cpf($input->getCpf());
        $person = $this->repository->getByCpf($cpf);

        $fileContent = $this->personPdfExporter->generate($person);

        $this->storage->store($input->getPdfFilename(), $input->getPdfPath(), $fileContent);

        return new OutputBoundary($input->getPdfPath() . DIRECTORY_SEPARATOR . $input->getPdfFilename());
    }
}