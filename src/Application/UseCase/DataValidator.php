<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\UseCase;

use Dimkinthepro\Http\Application\Component\Exception\ValidationExceptionInterface;
use Dimkinthepro\Http\Application\Component\Service\ValidatorServiceInterface;

final readonly class DataValidator
{
    public function __construct(
        private ValidatorServiceInterface $validatorService
    ) {
    }

    /**
     * @throws ValidationExceptionInterface
     */
    public function validate(object $object, string|array $groups = null): void
    {
        $this->validatorService->validate($object, $groups);
    }
}
