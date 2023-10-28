<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\Component\DTO;

readonly class ValidationFieldDTO
{
    public function __construct(
        public string $message,
        public ?string $code,
        public array $data,
    ) {
    }
}
