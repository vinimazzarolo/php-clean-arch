<?php

declare (strict_types = 1);

namespace App\Infra\Repositories\MySQL;

use App\Domain\Entities\Person;
use App\Domain\Exceptions\PersonNotFoundException;
use App\Domain\Repositories\IPersonRepository;
use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;
use DateTimeImmutable;
use PDO;

final class PdoPersonRepository implements IPersonRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getByCpf(Cpf $cpf): Person
    {
        $statement = $this->pdo->prepare('SELECT * FROM `people` WHERE `cpf` = :cpf');
        $statement->execute([':cpf' => (string) $cpf]);
        $record = $statement->fetch();

        if (!$record) {
            throw new PersonNotFoundException($cpf);
        }

        $person = new Person();
        $person->setName($record['name'])
            ->setEmail(new Email($record['email']))
            ->setCpf(new Cpf($record['cpf']))
            ->setBirthDate(new DateTimeImmutable($record['birthDate']));

        return $person;
    }
}