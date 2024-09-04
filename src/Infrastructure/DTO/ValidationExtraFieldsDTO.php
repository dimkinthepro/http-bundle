<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\DTO;

use Dimkinthepro\Http\Application\Component\DTO\ValidationFieldDTO;

readonly class ValidationExtraFieldsDTO extends ValidationFieldDTO
{
    public function __construct(
        array $data,
    ) {
        parent::__construct(
            'Extra fields error',
            '0326c3c2-a4de-4138-a455-78e121b4d16a',
            $data
        );
    }
}
