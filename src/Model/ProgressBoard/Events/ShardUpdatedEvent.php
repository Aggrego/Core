<?php

namespace Aggrego\Domain\Model\ProgressBoard\Events;

use Aggrego\Domain\Event\Model\Events\Event;
use Aggrego\Domain\Model\ProgressBoard\Entity\FinalShard;

class ShardUpdatedEvent extends Event
{
    public function __construct(FinalShard $shard)
    {
        parent::__construct(
            [
                'shard_uuid' => $shard->getUuid()->getValue(),
                'source' => [
                    'name' => $shard->getAcceptableSource()->getName()->getValue(),
                    'version' => $shard->getAcceptableSource()->getVersion()->getValue(),
                ],
                'data' => $shard->getData()->getValue()
            ]
        );
    }
}
