<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard\Events;

use Aggrego\Domain\Shared\Event\Model\Events\Event;

class UpdatedLastStepsShardEvent extends Event
{
    public function __construct()
    {
        parent::__construct([]);
    }
}
