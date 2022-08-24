<?php

declare(strict_types = 1);

namespace App\Application\Contracts;

interface IStorage
{
    public function store(string $filename, string $path, string $content);
}