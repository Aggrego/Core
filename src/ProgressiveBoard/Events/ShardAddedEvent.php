<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Events;

use Aggrego\Domain\ProgressiveBoard\Shard\InitialItem;
use Aggrego\Domain\Shared\Event\Model\Events\Event;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class ShardAddedEvent extends Event
{
    public function __construct(Uuid $uuid, InitialItem $board)
    {
        parent::__construct(
            [
                'uuid' => $uuid->getValue(),
                'shard_uuid' => $board->getUuid()->getValue(),
                'key' => $board->getKey()->getValue(),
                'profile' => $board->getProfile()->__toString()
            ]
        );
    }
}
