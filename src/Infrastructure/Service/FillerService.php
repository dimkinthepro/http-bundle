<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\Service;

use Dimkinthepro\Http\Application\Component\Service\FillerServiceInterface;
use Dimkinthepro\Http\Infrastructure\DTO\ValidationExtraFieldsDTO;
use Dimkinthepro\Http\Infrastructure\DTO\ValidationFieldTypeDTO;
use Dimkinthepro\Http\Infrastructure\Exception\ValidationException;

readonly class FillerService implements FillerServiceInterface
{
    public function __construct(
        private bool $extraFieldsAllowed,
    ) {
    }

    public function fill(object $object, array $data): void
    {
        foreach ($data as $key => $value) {
            try {
                if (property_exists($object, $key)) {
                    $object->$key = $value;
                } elseif (!$this->extraFieldsAllowed) {
                    $error = [
                        'message' => 'Extra field',
                        'value' => $value,
                    ];

                    throw new ValidationException(
                        'Extra fields not allowed',
                        ValidationException::CODE_EXTRA_FIELD,
                        $object::class,
                        ...[$key => new ValidationExtraFieldsDTO($error)]
                    );
                }
            } catch (\TypeError $e) {
                preg_match('/\:\:\$([a-z\d]+) of type \??([a-z]+)/i', $e->getMessage(), $matches);
                $expectedType = $matches[2] ?? 'UNKNOWN';

                $error = [
                    'message' => sprintf('Expected type "%s"', $expectedType),
                    'value' => $value,
                ];

                throw new ValidationException(
                    'Field type error',
                    ValidationException::CODE_TYPE_ERROR,
                    $object::class,
                    ...[$key => new ValidationFieldTypeDTO($error)]
                );
            }
        }
    }
}
