<?php

declare(strict_types=1);

namespace App\Application\UseCase\GetAllNews;

use App\Application\Dto\NewsDto;

class GetAllNewsResponse
{


    /**
     * @param NewsDto[] $news
     */
    public function __construct( public readonly array $news)
    {
    }

}
