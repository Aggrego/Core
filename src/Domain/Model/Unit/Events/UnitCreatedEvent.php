<?php

namespace TimiTao\Construo\Domain\Model\Unit\Events;

use TimiTao\Construo\Domain\Event\Model\Events\Event;
use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;

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
