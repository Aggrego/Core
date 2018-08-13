<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Event;

interface Aggregate
{
    public function pullEvents(): Events;
}
