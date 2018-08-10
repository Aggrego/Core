<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard\Events;

use Aggrego\Domain\Model\ProgressiveBoard\Step\Steps\FinalStep;
use Aggrego\Domain\Shared\Event\Model\Events\Event;

class FinalBoardTransformedEvent extends Event
{
    public function __construct(FinalStep $step)
    {
        parent::__construct(
            [
                'state' => $step->getState()->getValue(),
                'data' => $step->getData()->getValue()
            ]
        );
    }
}
