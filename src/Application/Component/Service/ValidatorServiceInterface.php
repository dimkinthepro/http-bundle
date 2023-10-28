<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\Application\Component\Service;

use Dimkinthepro\Http\Application\Component\Exception\ValidationExceptionInterface;

interface ValidatorServiceInterface
{
    /**
     * @throws ValidationExceptionInterface
     */
    public function validate(object $object, string|array $groups = null): void;
}
