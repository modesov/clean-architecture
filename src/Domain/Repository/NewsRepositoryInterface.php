<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\News;

interface NewsRepositoryInterface
{
    /**
     * @return News[]
     */
    public function findAll(): array;

    public function findById(int $id): ?News;

    /**
     * @param int[] $ids
     * @return News[]
     */
    public function findByIds(array $ids): array;

    public function save(News $news): void;

    public function delete(News $news): void;
}