<?php

use App\Application\UseCases\ExportPerson\ExportPerson;
use App\Application\UseCases\ExportPerson\InputBoundary;
use App\Domain\Entities\Person;
use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;
use App\Infra\Adapters\Html2PdfAdapter;
use App\Infra\Adapters\LocalStorageAdapter;

require_once __DIR__ . '/../vendor/autoload.php';

// Entities
$person = new Person();

$person->setName('Vinícius Mazzarolo')
    ->setEmail(new Email('vinimazzarolo1@outlook.com'))
    ->setCpf(new Cpf('01234567890'))
    ->setBirthDate(new DateTimeImmutable('2000-07-07'));


// Use cases
$personRepository = new stdClass();
$personPdfExporter = new Html2PdfAdapter();
$storage = new LocalStorageAdapter();


$content = $personPdfExporter->generate($person);
$rootDirectory = dirname(dirname(__FILE__));
$storage->store('test.pdf',  $rootDirectory . '/storage/people', $content);
die();


$exportPersonUseCase = new ExportPerson($personRepository, $personPdfExporter, $storage);
$input = new InputBoundary('01234567890', 'xpto', __DIR__ . '/../storage');
$output = $exportPersonUseCase->handle($input);