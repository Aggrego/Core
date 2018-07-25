<?php

namespace TimiTao\Construo\Domain\Model\ProgressBoard\Events;

use TimiTao\Construo\Domain\Event\Model\Events\Event;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\Board;

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
