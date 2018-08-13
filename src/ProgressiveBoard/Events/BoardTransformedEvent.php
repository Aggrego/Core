<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Events;

use Aggrego\Domain\ProgressiveBoard\Step\Step;
use Aggrego\Domain\Shared\Event\Model\Events\Event;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class BoardTransformedEvent extends Event
{
    public function __construct(Uuid $uuid, Step $step)
    {
        parent::__construct(
            [
                'uuid' => $uuid->getValue(),
                'state' => $step->getState()->getValue(),
            ]
        );
    }
}
