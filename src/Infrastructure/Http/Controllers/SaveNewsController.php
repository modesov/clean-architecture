<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCase\SaveNews\SaveNewsRequest;
use App\Application\UseCase\SaveNews\SaveNewsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class SaveNewsController extends AbstractController
{
    public function __construct(
        private SaveNewsUseCase $useCase
    ) {
    }

    #[Route('/api/news/', methods: 'POST', )]
    public function __invoke(#[MapRequestPayload] SaveNewsRequest $request): JsonResponse
    {
        try {
            $response = ($this->useCase)($request);
            return new JsonResponse($response);
        } catch ( Throwable $exception ) {
            return new JsonResponse(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }
}