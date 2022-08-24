<?php

declare(strict_types = 1);

namespace App\Application\UseCases\ExportPerson;

use App\Domain\Repositories\IPersonRepository;
use App\Domain\ValueObjects\CPF;
use DateTime;

final class ExportPerson
{
    private IPersonRepository $repository;

    public function __construct(IPersonRepository $repository)
    {
        $this->repository = $repository;   
    }

    public function handle(InputBoundary $input): OutputBoundary
    {
        $cpf = new CPF($input->getCPF());
        $person = $this->repository->getByCpf($cpf);

        return new OutputBoundary([
            'name' => $person->getName(),
            'email' => (string) $person->getEmail(),
            'cpf' => (string) $person->getCPF(),
            'birthDate' => $person->getBirthDate()->format(DateTime::ATOM)
        ]);
    }
}