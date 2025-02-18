<?php

declare(strict_types=1);

namespace App\Application\UseCase\ReportGeneration;

class ReportGenerationResponse
{
    public function __construct(public readonly string $reportUrl)
    {
    }
}