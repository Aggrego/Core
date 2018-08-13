<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Events;

use Aggrego\Domain\ProgressiveBoard\Step\Steps\FinalStep;
use Aggrego\Domain\Shared\Event\Model\Events\Event;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class FinalBoardTransformedEvent extends Event
{
    public function __construct(Uuid $uuid, FinalStep $step)
    {
        parent::__construct(
            [
                'uuid' => $uuid->getValue(),
                'state' => $step->getState()->getValue(),
                'data' => $step->getData()->getValue()
            ]
        );
    }
}
