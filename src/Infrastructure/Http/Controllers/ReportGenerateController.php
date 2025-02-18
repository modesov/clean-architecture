<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCase\ReportGeneration\ReportGenerationRequest;
use App\Application\UseCase\ReportGeneration\ReportGenerationUseCase;
use App\Application\UseCase\SaveNews\SaveNewsRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class ReportGenerateController extends AbstractController
{
    public function __construct(
        private ReportGenerationUseCase $useCase
    ) {
    }

    #[Route('/api/report_generate/', methods: 'POST', )]
    public function __invoke(#[MapRequestPayload] ReportGenerationRequest $request): JsonResponse
    {
        try {
            $response = ($this->useCase)($request);
            return new JsonResponse($response);
        } catch ( Throwable $exception ) {
            return new JsonResponse(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }
}