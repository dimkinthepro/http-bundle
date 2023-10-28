<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\UseCase;

use Dimkinthepro\Http\Application\Component\Service\RequestServiceInterface;
use Symfony\Component\HttpFoundation\Request;

final readonly class RequestDataExtractor
{
    public function __construct(
        private RequestServiceInterface $requestService
    ) {
    }

    public function getData(Request $request): array
    {
        return $this->requestService->getRequestData($request);
    }
}
