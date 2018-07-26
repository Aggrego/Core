<?php

namespace Aggrego\Domain\Model\InitialBoard\ValueObject;

use Assert\Assertion;
use Aggrego\Domain\Model\InitialBoard\Entity\Shard;
use Aggrego\Domain\ValueObject\Shards as BaseShards;

class Shards extends BaseShards
{
    public function __construct(array $list = [])
    {
        parent::__construct($list);
        Assertion::allIsInstanceOf($list, Shard::class);
    }

    public function add(Shard $shard): void
    {
        $this->list[] = $shard;
    }
}
