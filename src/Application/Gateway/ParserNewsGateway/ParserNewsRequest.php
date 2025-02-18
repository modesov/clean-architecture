<?php

declare(strict_types=1);

namespace App\Application\Gateway\ParserNewsGateway;

class ParserNewsRequest
{
    public function __construct(
        public readonly string $url,
    ){
    }
}