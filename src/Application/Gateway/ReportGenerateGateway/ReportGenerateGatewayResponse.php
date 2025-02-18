<?php

namespace App\Application\Gateway\ReportGenerateGateway;

use App\Application\Dto\NewsDto;

class ReportGenerateGatewayResponse
{
    public function __construct(public readonly string $reportUrl)
    {
    }
}