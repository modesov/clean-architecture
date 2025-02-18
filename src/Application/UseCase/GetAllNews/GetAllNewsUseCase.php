<?php

declare(strict_types=1);

namespace App\Application\UseCase\GetAllNews;

use App\Application\Dto\NewsDto;
use App\Domain\Entity\News;
use App\Domain\Repository\NewsRepositoryInterface;

class GetAllNewsUseCase
{
    public function __construct(private NewsRepositoryInterface $newsRepository)
    {
    }

    public function __invoke(): GetAllNewsResponse
    {
        $arNews = $this->newsRepository->findAll();

        $dtos = array_map(function (News $news) {
            return new NewsDto(
                $news->getId(),
                $news->getUrl()->getValue(),
                $news->getName()->getValue(),
                $news->getDate()
            );
        }, $arNews);

        return new GetAllNewsResponse($dtos);
    }
}
