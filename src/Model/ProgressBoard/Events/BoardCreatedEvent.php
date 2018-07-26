<?php

namespace Aggrego\Domain\Model\ProgressBoard\Events;

use Aggrego\Domain\Event\Model\Events\Event;
use Aggrego\Domain\Model\ProgressBoard\Entity\Board;

class BoardCreatedEvent extends Event
{
    public function __construct(Board $shard)
    {
        parent::__construct(
            [
                'uuid' => $shard->getUuid()->getValue(),
                'key' => $shard->getKey()->getValue(),
                'profile' => [
                    'name' => $shard->getProfile()->getName()->getValue(),
                    'version' => $shard->getProfile()->getVersion()->getValue(),
                ],
            ]
        );
    }
}
