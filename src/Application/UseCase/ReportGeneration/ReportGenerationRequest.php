<?php

declare(strict_types=1);

namespace App\Application\UseCase\ReportGeneration;

class ReportGenerationRequest
{
    /**
     * @param int[] $ids
     */
    public function __construct(public readonly array $ids)
    {
    }
}