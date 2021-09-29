<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Event\Shared;

use Aggrego\Infrastructure\Contract\Event\Event;
use ArrayIterator;
use Iterator;
use IteratorAggregate;

/** @implements \IteratorAggregate<int, Event> */
class Events implements IteratorAggregate
{
    /** @var array<int,Event> $list */
    private array $list;

    /**
     * @param array<int,Event> ...$list
     */
    public function __construct(Event ...$list)
    {
        $this->list = $list;
    }

    public function add(Event $event): void
    {
        $this->list[] = $event;
    }

    /** @return \ArrayIterator<int,Event> $list */
    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->list);
    }
}
