<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Events;

use Aggrego\Domain\ProgressiveBoard\Shard\FinalItem;
use Aggrego\Domain\Shared\Event\Model\Events\Event;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class ShardUpdatedEvent extends Event
{
    public function __construct(Uuid $uuid, FinalItem $board)
    {
        parent::__construct(
            [
                'uuid' => $uuid->getValue(),
                'shard_uuid' => $board->getUuid()->getValue(),
                'profile' => $board->getProfile()->__toString(),
                'data' => $board->getData()->getValue()
            ]
        );
    }
}
