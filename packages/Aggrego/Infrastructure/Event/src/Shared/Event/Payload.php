<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Event\Shared\Event;

use Aggrego\Infrastructure\Event\Payload as EventPayload;
use Exception;
use TimiTao\ValueObject\Beberlei\Standard\ArrayValueObject;

class Payload extends ArrayValueObject implements EventPayload
{
    /**
     * @throws Exception if value is invalid
     */
    protected function guard(array $value): void
    {
        return;
    }
}
