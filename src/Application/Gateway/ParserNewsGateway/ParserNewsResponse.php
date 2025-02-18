<?php

declare(strict_types = 1);

namespace App\Application\Gateway\ParserNewsGateway;

class ParserNewsResponse
{
    public function __construct(
        public readonly string $name
    ) {
    }
}