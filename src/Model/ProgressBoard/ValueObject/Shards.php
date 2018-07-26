<?php

namespace Aggrego\Domain\Model\ProgressBoard\ValueObject;

use Assert\Assertion;
use Countable;
use Aggrego\Domain\Model\Board\Entity\Shard;
use Aggrego\Domain\Model\ProgressBoard\Entity\FinalShard;
use Aggrego\Domain\Model\ProgressBoard\Entity\InitialShard;
use Aggrego\Domain\Model\ProgressBoard\Exception\InvalidUuidComparisonOnReplaceException;
use Aggrego\Domain\ValueObject\Shards as BaseShards;

class Shards extends BaseShards implements Countable
{
    public function __construct(array $list = [])
    {
        parent::__construct($list);
        Assertion::allIsInstanceOf($list, InitialShard::class);
    }

    public function replace(FinalShard $finalShard): void
    {
        /** @var Shard $shard */
        $list = $this->list;
        $uuids = [];
        foreach ($list as $key => $shard) {
            if ($shard instanceof FinalShard) {
                continue;
            }
            $uuids[] = $shard->getUuid()->getValue();
            if ($shard->getUuid()->equal($finalShard->getUuid())
                && $shard->getAcceptableSource()->equal($finalShard->getAcceptableSource())) {
                $list[$key] = $finalShard;
                $this->list = $list;
                return;
            }
        }

        throw new InvalidUuidComparisonOnReplaceException(
            sprintf(
                'Couldn\'t find initial shard by uuid %s in given collection: %s',
                $finalShard->getUuid()->getValue(),
                join(',', $uuids)
            )
        );
    }

    public function count(): int
    {
        return count($this->list);
    }
}
