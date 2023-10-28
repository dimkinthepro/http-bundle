<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\Exception;

use Dimkinthepro\Http\Application\Component\DTO\ValidationFieldDTO;
use Dimkinthepro\Http\Application\Component\Exception\ValidationExceptionInterface;

class ValidationException extends \InvalidArgumentException implements ValidationExceptionInterface
{
    public const CODE_EXTRA_FIELD = 77700201;
    public const CODE_VALIDATION_FIELD = 77700202;
    public const CODE_TYPE_ERROR = 77700203;

    private array $errors;
    private string $validatedObjectClass;

    public function __construct(
        string $message,
        int $code,
        string $validatedObjectClass,
        ValidationFieldDTO ...$errors,
    ) {
        parent::__construct($message, $code);

        $this->validatedObjectClass = $validatedObjectClass;
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getValidatedObjectClass(): string
    {
        return $this->validatedObjectClass;
    }
}
