<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard\Events;

use Aggrego\Domain\Model\ProgressiveBoard\Step\Step;
use Aggrego\Domain\Shared\Event\Model\Events\Event;

class BoardTransformedEvent extends Event
{
    public function __construct(Step $step)
    {
        parent::__construct(
            [
                'state' => $step->getState()->getValue(),
            ]
        );
    }
}
