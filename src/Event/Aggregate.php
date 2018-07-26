<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Event;

use Aggrego\Domain\ValueObject\Uuid;

interface Aggregate
{
    public function getUuid(): Uuid;

    public function pullEvents(): Events;
}
