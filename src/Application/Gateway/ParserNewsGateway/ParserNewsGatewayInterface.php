<?php

declare(strict_types = 1);

namespace App\Application\Gateway\ParserNewsGateway;

interface ParserNewsGatewayInterface
{
    public function parseNews(ParserNewsRequest $request): ParserNewsResponse;
}