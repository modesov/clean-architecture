<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\UseCase\GetAllNews\GetAllNewsUseCase;
use App\Application\UseCase\SaveNews\SaveNewsRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class GetAllNewsController extends AbstractController
{
    public function __construct(
        private GetAllNewsUseCase $useCase
    ) {
    }

    #[Route('/api/news/', methods: 'GET', )]
    public function __invoke(): JsonResponse
    {
        try {
            $response = ($this->useCase)();
            return new JsonResponse($response);
        } catch ( Throwable $exception ) {
            return new JsonResponse(['message' => $exception->getMessage(), 'code' => $exception->getCode()]);
        }
    }
}