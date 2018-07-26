<?php

namespace Aggrego\Domain\Model\ProgressBoard\Events;

use Aggrego\Domain\Event\Model\Events\Event;
use Aggrego\Domain\Model\ProgressBoard\Entity\InitialShard;

class ShardAddedEvent extends Event
{
    public function __construct(InitialShard $shard)
    {
        parent::__construct(
            [
                'shard_uuid' => $shard->getUuid()->getValue(),
                'key' => $shard->getKey()->getValue(),
                'source' => [
                    'name' => $shard->getAcceptableSource()->getName()->getValue(),
                    'version' => $shard->getAcceptableSource()->getVersion()->getValue(),
                ],
            ]
        );
    }
}
