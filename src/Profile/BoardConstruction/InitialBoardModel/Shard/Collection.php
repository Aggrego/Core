<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\Shard;

use ArrayIterator;
use Assert\Assertion;
use Iterator;
use IteratorAggregate;

class Collection implements IteratorAggregate
{
    /** @var array */
    private $list;

    public function __construct(array $list = [])
    {
        Assertion::allIsInstanceOf($list, Item::class);
        $this->list = $list;
    }

    public function add(Item $item): void
    {
        $this->list[] = $item;
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->list);
    }
}
