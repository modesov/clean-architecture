<?php

declare(strict_types=1);

namespace App\Application\UseCase\SaveNews;

class SaveNewsResponse
{
    public function __construct(public readonly int $id)
    {
    }
}