<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\Component\Service;

use Symfony\Component\HttpFoundation\Request;

interface RequestServiceInterface
{
    public function getRequestData(Request $request): array;
}
