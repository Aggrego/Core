<?php

namespace Aggrego\Domain\ValueObject;

use ArrayIterator;
use Assert\Assertion;
use Iterator;
use IteratorAggregate;
use Aggrego\Domain\Model\Board\Entity\Shard;

class Shards implements IteratorAggregate
{
    /** @var array */
    protected $list;

    public function __construct(array $list = [])
    {
        Assertion::allIsInstanceOf($list, Shard::class);
        $this->list = $list;
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->list);
    }
}
