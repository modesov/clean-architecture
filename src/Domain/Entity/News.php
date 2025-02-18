<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\NewsName;
use App\Domain\ValueObject\NewsUrl;
use DateTime;

class News
{
    private ?int $id = null;

    public function __construct(
        private NewsUrl $url,
        private NewsName $name,
        private DateTime $date = new DateTime(),
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return NewsUrl
     */
    public function getUrl(): NewsUrl
    {
        return $this->url;
    }

    /**
     * @return NewsName
     */
    public function getName(): NewsName
    {
        return $this->name;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }
}
