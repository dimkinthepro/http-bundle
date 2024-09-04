<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\UseCase;

use Dimkinthepro\Http\Application\Component\Factory\ExceptionResponseFactoryInterface;
use Symfony\Component\HttpFoundation\Response;

final readonly class ExceptionHandler
{
    public function __construct(
        private ExceptionResponseFactoryInterface $exceptionResponseFactory
    ) {
    }

    public function handleException(\Throwable $e): Response
    {
        return $this->exceptionResponseFactory->handleException($e);
    }
}
