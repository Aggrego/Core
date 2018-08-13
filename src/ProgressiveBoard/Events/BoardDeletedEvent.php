<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Events;

use Aggrego\Domain\Shared\Event\Model\Events\Event;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class BoardDeletedEvent extends Event
{
    public function __construct(Uuid $uuid)
    {
        parent::__construct(['uuid' => $uuid->getValue()]);
    }
}
