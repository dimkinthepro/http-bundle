<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\Service;

use Dimkinthepro\Http\Application\Component\Service\RequestServiceInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class RequestService implements RequestServiceInterface
{
    public function getRequestData(Request $request): array
    {
        $data = array_merge($request->query->all(), $request->request->all());
        $body = json_decode($request->getContent(), true) ?? [];

        return array_merge($data, $body);
    }
}
