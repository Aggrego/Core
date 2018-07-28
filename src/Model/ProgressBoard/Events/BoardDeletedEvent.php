<?php

namespace Aggrego\Domain\Model\ProgressBoard\Events;

use Aggrego\Domain\Event\Model\Events\Event;

class BoardDeletedEvent extends Event
{
    public function __construct()
    {
        parent::__construct([]);
    }
}
