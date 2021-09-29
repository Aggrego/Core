<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Event\Shared\Event;

use Aggrego\Infrastructure\Contract\Event\Payload as EventPayload;
use Exception;
use TimiTao\ValueObject\Beberlei\Standard\ArrayValueObject;

class Payload extends ArrayValueObject implements EventPayload
{
    /**
     * @throws Exception if value is invalid
     * @param array<mixed> $value
     */
    protected function guard(array $value): void
    {
    }
}
