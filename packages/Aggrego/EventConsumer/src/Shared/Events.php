<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace Aggrego\EventConsumer\Shared;

use Aggrego\EventConsumer\Event;
use ArrayIterator;
use Iterator;
use IteratorAggregate;

class Events implements IteratorAggregate
{
    /**
     * @var array
     */
    private $list;

    public function __construct()
    {
        $this->list = [];
    }

    public function add(Event $event)
    {
        $this->list[] = $event;
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->list);
    }
}
