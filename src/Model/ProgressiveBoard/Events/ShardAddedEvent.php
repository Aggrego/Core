<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard\Events;

use Aggrego\Domain\Model\ProgressiveBoard\Shard\InitialItem;
use Aggrego\Domain\Shared\Event\Model\Events\Event;

class ShardAddedEvent extends Event
{
    public function __construct(InitialItem $board)
    {
        parent::__construct(
            [
                'shard_uuid' => $board->getUuid()->getValue(),
                'key' => $board->getKey()->getValue(),
                'profile' => $board->getProfile()->__toString()
            ]
        );
    }
}
