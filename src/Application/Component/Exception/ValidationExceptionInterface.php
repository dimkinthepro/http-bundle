<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\Component\Exception;

use Dimkinthepro\Http\Application\Component\DTO\ValidationFieldDTO;

interface ValidationExceptionInterface extends \Throwable
{
    /**
     * @return ValidationFieldDTO[]
     */
    public function getErrors(): array;

    public function getValidatedObjectClass(): string;
}
