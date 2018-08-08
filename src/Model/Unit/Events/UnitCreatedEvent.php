<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\Unit\Events;

use Aggrego\Domain\Model\Unit\Unit;
use Aggrego\Domain\Shared\Event\Model\Events\Event;

class UnitCreatedEvent extends Event
{
    public function __construct(Unit $unit)
    {
        parent::__construct(
            [
                'key' => $unit->getUuid()->getValue(),
                'profile' => [
                    'name' => $unit->getProfile()->getName()->getValue(),
                    'version' => $unit->getProfile()->getVersion()->getValue(),
                ],
                'data' => $unit->getData()
            ]
        );
    }
}
