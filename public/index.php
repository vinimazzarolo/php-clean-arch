<?php

use App\Application\UseCases\ExportPerson\ExportPerson;
use App\Application\UseCases\ExportPerson\InputBoundary;
use App\Domain\Entities\Person;
use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;
use App\Infra\Adapters\Html2PdfAdapter;
use App\Infra\Adapters\LocalStorageAdapter;
use App\Infra\Repositories\MySQL\PdoPersonRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$appConfig = require_once __DIR__ . '/../config/app.php';

// Entities
$person = new Person();

$person->setName('Vinícius Mazzarolo')
    ->setEmail(new Email('vinimazzarolo1@outlook.com'))
    ->setCpf(new Cpf('01234567890'))
    ->setBirthDate(new DateTimeImmutable('2000-07-07'));


// Use cases

$dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
    $appConfig['db']['host'],
    $appConfig['db']['port'],
    $appConfig['db']['dbname'],
    $appConfig['db']['charset']
);

$pdo = new PDO($dsn, $appConfig['db']['username'], $appConfig['db']['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_PERSISTENT => TRUE
]);

$personRepository = new PdoPersonRepository($pdo);
$personPdfExporter = new Html2PdfAdapter();
$storage = new LocalStorageAdapter();

$entity = $personRepository->getByCpf(new Cpf('04172300014'));

echo '<pre>'; print_r($entity); die;

$content = $personPdfExporter->generate($person);
$rootDirectory = dirname(dirname(__FILE__));
$storage->store('test.pdf',  $rootDirectory . '/storage/people', $content);

$exportPersonUseCase = new ExportPerson($personRepository, $personPdfExporter, $storage);
$input = new InputBoundary('01234567890', 'xpto', __DIR__ . '/../storage');
$output = $exportPersonUseCase->handle($input);