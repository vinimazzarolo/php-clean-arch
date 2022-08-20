<?php

use App\Domain\Entities\Person;
use App\Domain\ValueObjects\CPF;
use App\Domain\ValueObjects\Email;

require_once __DIR__ . '/../vendor/autoload.php';

$person = new Person();

$person->setName('Vinícius Mazzarolo')
    ->setEmail(new Email('vinimazzarolo1@outlook.com'))
    ->setCPF(new CPF('01234567890'))
    ->setBirthDate(new DateTimeImmutable('2000-07-07'));

echo '<pre>'; print_r($person);