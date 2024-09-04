<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\UseCase;

use Dimkinthepro\Http\Application\Component\Exception\ValidationExceptionInterface;
use Dimkinthepro\Http\Application\Component\Service\FillerServiceInterface;

final readonly class DataBuilder
{
    public function __construct(
        private FillerServiceInterface $fillerService
    ) {
    }

    /**
     * @throws ValidationExceptionInterface
     */
    public function fill(object $object, array $data): void
    {
        $this->fillerService->fill($object, $data);
    }
}
