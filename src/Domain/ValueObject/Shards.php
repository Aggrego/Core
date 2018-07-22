<?php

namespace TimiTao\Construo\Domain\ValueObject;

use ArrayIterator;
use Assert\Assertion;
use Iterator;
use IteratorAggregate;
use TimiTao\Construo\Domain\Model\Board\Entity\Shard;

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
