<?php

use App\Application\UseCases\ExportPerson\ExportPerson;
use App\Application\UseCases\ExportPerson\InputBoundary;
use App\Domain\Entities\Person;
use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;
use App\Infra\Adapters\Html2PdfAdapter;
use App\Infra\Adapters\LocalStorageAdapter;
use App\Infra\Http\Controllers\ExportPersonController;
use App\Infra\Presentation\ExportPersonPresenter;
use App\Infra\Repositories\MySQL\PdoPersonRepository;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

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

$entity = $personRepository->getByCpf(new Cpf('01234567890'));

$content = $personPdfExporter->generate($person);
$rootDirectory = dirname(dirname(__FILE__));
$storage->store('test.pdf',  $rootDirectory . '/storage/people', $content);

$exportPersonUseCase = new ExportPerson($personRepository, $personPdfExporter, $storage);

$request = new Request('GET', 'http://localhost');
$response = new Response();

$exportPersonPresenter = new ExportPersonPresenter();

header("Content-type: application/json; charset=utf-8");

$exportPersonController = new ExportPersonController($request, $response, $exportPersonUseCase);
echo $exportPersonController->handle($exportPersonPresenter);
