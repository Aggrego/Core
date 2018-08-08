<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Event;

use Aggrego\Domain\Shared\ValueObject\Uuid;

interface Aggregate
{
    public function getUuid(): Uuid;

    public function pullEvents(): Events;
}
