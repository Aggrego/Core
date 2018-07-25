<?php

namespace TimiTao\Construo\Domain\Model\ProgressBoard\Events;

use TimiTao\Construo\Domain\Event\Model\Events\Event;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\InitialShard;

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
