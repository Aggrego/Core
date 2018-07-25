<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Event;

use TimiTao\Construo\Domain\ValueObject\Uuid;

interface Aggregate
{
    public function getUuid(): Uuid;

    public function pullEvents(): Events;
}
