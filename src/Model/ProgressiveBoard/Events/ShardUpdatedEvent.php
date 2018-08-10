<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressiveBoard\Events;

use Aggrego\Domain\Model\ProgressiveBoard\Shard\FinalItem;
use Aggrego\Domain\Shared\Event\Model\Events\Event;

class ShardUpdatedEvent extends Event
{
    public function __construct(FinalItem $board)
    {
        parent::__construct(
            [
                'shard_uuid' => $board->getUuid()->getValue(),
                'profile' => $board->getProfile()->__toString(),
                'data' => $board->getData()->getValue()
            ]
        );
    }
}
