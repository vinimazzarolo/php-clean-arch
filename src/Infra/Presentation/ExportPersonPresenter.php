<?php

namespace App\Infra\Presentation;

use App\Infra\Http\Controllers\IPresentation;

final class ExportPersonPresenter implements IPresentation
{
    public function output(array $data): string
    {
        return json_encode($data);
    }
}