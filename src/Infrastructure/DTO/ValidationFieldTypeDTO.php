<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Infrastructure\DTO;

use Dimkinthepro\Http\Application\Component\DTO\ValidationFieldDTO;

readonly class ValidationFieldTypeDTO extends ValidationFieldDTO
{
    public function __construct(
        array $data,
    ) {
        parent::__construct(
            'Field type error',
            'cc74338c-399a-4d9c-9ae0-0866e66b2049',
            $data
        );
    }
}
