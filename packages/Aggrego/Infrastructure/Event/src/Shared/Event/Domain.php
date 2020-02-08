<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Event\Shared\Event;

use Aggrego\Infrastructure\Event\Domain as EventDomain;
use Exception;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

class Domain extends StringValueObject implements EventDomain
{
    /**
     * @throws Exception if value is invalid
     */
    protected function guard(string $value): void
    {
        return;
    }
}
