<?php

declare(strict_types=1);

namespace App\Application\Dto;

class NewsDto
{
    public function __construct(
        public readonly int       $id,
        public readonly string    $url,
        public readonly string    $name,
        public readonly \DateTime $date,
    ) {
    }
}