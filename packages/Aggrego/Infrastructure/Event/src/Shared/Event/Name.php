<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Event\Shared\Event;

use Aggrego\Infrastructure\Event\Name as EventName;
use Exception;
use TimiTao\ValueObject\Beberlei\Standard\StringValueObject;

class Name extends StringValueObject implements EventName
{
    /**
     * @throws Exception if value is invalid
     */
    protected function guard(string $value): void
    {
        return;
    }
}
