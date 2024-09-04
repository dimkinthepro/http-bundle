<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\Service;

use Dimkinthepro\Http\Application\Component\DTO\ValidationFieldDTO;
use Dimkinthepro\Http\Application\Component\Service\ValidatorServiceInterface;
use Dimkinthepro\Http\Infrastructure\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class ValidationService implements ValidatorServiceInterface
{
    public function __construct(
        private ValidatorInterface $validator
    ) {
    }

    public function validate(object $object, string|array $groups = null): void
    {
        $errors = [];
        $violations = $this->validator->validate($object, null, $groups);

        foreach ($violations as $violation) {
            $data = [];
            foreach ($violation->getParameters() as $parameterKey => $parameterValue) {
                $key = trim(str_replace(['{{', '}}'], '', $parameterKey));
                $data[$key] = $parameterValue;
            }

            $errors[$violation->getPropertyPath()] = new ValidationFieldDTO(
                (string) $violation->getMessage(),
                $violation->getCode(),
                $data
            );
        }

        if (\count($errors) > 0) {
            throw new ValidationException(
                'Validation field error',
                ValidationException::CODE_VALIDATION_FIELD,
                $object::class,
                ...$errors
            );
        }
    }
}
