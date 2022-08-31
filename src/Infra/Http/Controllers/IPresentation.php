<?php

declare (strict_types = 1);

namespace App\Infra\Http\Controllers;

interface IPresentation
{
    public function output(array $data): string;
}