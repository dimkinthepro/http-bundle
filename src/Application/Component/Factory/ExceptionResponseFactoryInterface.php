<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\Component\Factory;

use Symfony\Component\HttpFoundation\Response;

interface ExceptionResponseFactoryInterface
{
    public function handleException(\Throwable $e): Response;
}
