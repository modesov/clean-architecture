<?php

declare(strict_types=1);

namespace App\Application\UseCase\ReportGeneration;

use App\Application\Dto\NewsDto;
use App\Application\Gateway\ReportGenerateGateway\ReportGenerateGatewayInterface;
use App\Application\Gateway\ReportGenerateGateway\ReportGenerateGatewayRequest;
use App\Domain\Entity\News;
use App\Domain\Repository\NewsRepositoryInterface;

class ReportGenerationUseCase
{
    public function __construct(
        private NewsRepositoryInterface $newsRepository,
        private ReportGenerateGatewayInterface $reportGenerateGateway
    ) {
    }

    public function __invoke(ReportGenerationRequest $request): ReportGenerationResponse
    {
        $arNews = $this->newsRepository->findByIds($request->ids);

        if (empty($arNews)) {
            throw new \InvalidArgumentException('News not found');
        }

        $dtos = array_map(function (News $news) {
            return new NewsDto(
                $news->getId(),
                $news->getUrl()->getValue(),
                $news->getName()->getValue(),
                $news->getDate()
            );
        }, $arNews);

        $reportGenerationGatewayRequest = new ReportGenerateGatewayRequest($dtos);
        $reportGenerationGatewayResponse = $this->reportGenerateGateway->reportGenerate($reportGenerationGatewayRequest);

        return new ReportGenerationResponse($reportGenerationGatewayResponse->reportUrl);
    }
}