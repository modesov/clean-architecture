<?php

namespace App\Application\Gateway\ReportGenerateGateway;

use App\Application\Dto\NewsDto;

class ReportGenerateGatewayRequest
{
    /**
     * @param NewsDto[] $news
     */
    public function __construct( public readonly array $news)
    {
    }
}