<?php

declare (strict_types = 1);

namespace App\Infra\Http\Controllers;

use App\Application\UseCases\ExportPerson\ExportPerson;
use App\Application\UseCases\ExportPerson\InputBoundary;
use App\Application\UseCases\ExportPerson\OutputBoundary;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class ExportPersonController
{
    private RequestInterface $request;
    private ResponseInterface $response;
    private ExportPerson $useCase;

    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        ExportPerson $useCase
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->useCase = $useCase;
    }

    public function handle(IPresentation $presentation): string
    {
        $inputBoundary = new InputBoundary('01234567890', 'xpto.pdf', __DIR__ . '/../../../../storage/people');
        $output = $this->useCase->handle($inputBoundary);
        return $presentation->output([
            'fullFilename' => $output->getFullFilename()
        ]);
    }
}