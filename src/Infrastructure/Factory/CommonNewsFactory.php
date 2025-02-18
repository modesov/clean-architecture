<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Entity\News;
use App\Domain\Factory\NewsFactoryInterface;
use App\Domain\ValueObject\NewsName;
use App\Domain\ValueObject\NewsUrl;

class CommonNewsFactory implements NewsFactoryInterface
{
    public function create(string $url, string $name): News
    {
        return new News(
            new NewsUrl($url),
            new NewsName($name)
        );
    }
}