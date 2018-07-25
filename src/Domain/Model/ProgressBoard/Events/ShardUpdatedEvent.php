<?php

namespace TimiTao\Construo\Domain\Model\ProgressBoard\Events;

use TimiTao\Construo\Domain\Event\Model\Events\Event;
use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\FinalShard;

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
