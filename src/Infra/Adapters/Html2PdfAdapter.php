<?php

declare(strict_types = 1);

namespace App\Infra\Adapters;

use App\Application\Contracts\IPersonPdfExporter;
use App\Domain\Entities\Person;
use HTML2PDF_exception;
use Spipu\Html2Pdf\Html2Pdf;

final class Html2PdfAdapter implements IPersonPdfExporter
{
    public function generate(Person $person): string
    {
        $html2pdf = new Html2Pdf();

        try {
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML('<p>Nome: ' . $person->getName() . '</p><p>CPF: ' . $person->getCpf() . '</p>');
            return $html2pdf->output('', 'S');
        } catch (HTML2PDF_exception $exception) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }

    }
}
