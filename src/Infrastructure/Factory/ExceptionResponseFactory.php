<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\Factory;

use Dimkinthepro\Http\Application\Component\Exception\ValidationExceptionInterface;
use Dimkinthepro\Http\Application\Component\Factory\ExceptionResponseFactoryInterface;
use Dimkinthepro\Http\Infrastructure\Enumeration\ResponseFormatEnum;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class ExceptionResponseFactory implements ExceptionResponseFactoryInterface
{
    public function __construct(
        private string $responseErrorFormat,
    ) {
    }

    public function handleException(\Throwable $e): Response
    {
        $format = ResponseFormatEnum::from($this->responseErrorFormat);
        $data = match (true) {
            $e instanceof ValidationExceptionInterface => $this->getValidationData($e),
            default => $this->getDefaultData($e),
        };

        return match (true) {
            ResponseFormatEnum::JSON === $format => $this->getJsonResponse($data),
        };
    }

    private function getJsonResponse(array $data): JsonResponse
    {
        return new JsonResponse(
            $data,
            Response::HTTP_BAD_REQUEST,
            ['Content-Type' => 'application/json']
        );
    }

    private function getValidationData(ValidationExceptionInterface $e): array
    {
        return [
            'type' => 'Validation Exception',
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
            'data' => $e->getErrors(),
        ];
    }

    private function getDefaultData(\Throwable $e): array
    {
        return [
            'type' => 'Exception',
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ];
    }
}
