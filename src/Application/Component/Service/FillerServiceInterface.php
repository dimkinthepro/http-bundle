<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\Component\Service;

use Dimkinthepro\Http\Application\Component\Exception\ValidationExceptionInterface;

interface FillerServiceInterface
{
    /**
     * @throws ValidationExceptionInterface
     */
    public function fill(object $object, array $data): void;
}
