<?php

declare(strict_types=1);

namespace App\Application\UseCase\SaveNews;

use App\Application\Gateway\ParserNewsGateway\ParserNewsGatewayInterface;
use App\Application\Gateway\ParserNewsGateway\ParserNewsRequest;
use App\Domain\Factory\NewsFactoryInterface;
use App\Domain\Repository\NewsRepositoryInterface;

class SaveNewsUseCase
{
    public function __construct(
        private readonly NewsFactoryInterface $newsFactory,
        private readonly NewsRepositoryInterface $newsRepository,
        private readonly ParserNewsGatewayInterface $parserNewsGateway
    ) {
    }

    public function __invoke(SaveNewsRequest $request): SaveNewsResponse
    {
        $parserNewsRequest = new ParserNewsRequest($request->url);

        $parserNewsResponse = $this->parserNewsGateway->parseNews($parserNewsRequest);

        $news = $this->newsFactory->create($request->url, $parserNewsResponse->name);

        $this->newsRepository->save($news);

        return  new SaveNewsResponse($news->getId());
    }
}