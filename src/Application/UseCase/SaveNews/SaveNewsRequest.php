<?php

declare(strict_types=1);

namespace App\Application\UseCase\SaveNews;

class SaveNewsRequest
{
    public function __construct(
        public readonly string $url,
    ) {
    }
}