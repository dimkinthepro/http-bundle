<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\DTO;

use Dimkinthepro\Http\Application\Component\DTO\ValidationFieldDTO;

readonly class ValidationFieldValueDTO extends ValidationFieldDTO
{
    public function __construct(
        array $data,
    ) {
        parent::__construct(
            'Field value error',
            '6c4a623f-8473-4659-9aba-687ca0937442',
            $data
        );
    }
}
