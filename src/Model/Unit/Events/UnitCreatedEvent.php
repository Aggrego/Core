<?php

namespace Aggrego\Domain\Model\Unit\Events;

use Aggrego\Domain\Event\Model\Events\Event;
use Aggrego\Domain\Model\Unit\Entity\Unit;

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
