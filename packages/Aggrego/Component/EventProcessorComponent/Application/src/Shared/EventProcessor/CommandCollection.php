<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\EventProcessorComponent\Application\Shared\EventProcessor;

use Aggrego\Infrastructure\Contract\Command\Command;
use Aggrego\Component\EventProcessorComponent\Application\EventProcessor\CommandCollection as
    CommandCollectionInterface;
use ArrayIterator;
use Iterator;
use IteratorAggregate;

/** @implements \IteratorAggregate<int, Command> */
class CommandCollection implements IteratorAggregate, CommandCollectionInterface
{
    /** @var array<int, Command> ...$commands */
    private array $list;

    public function __construct(Command ...$list)
    {
        $this->list = $list;
    }

    /** @return \Iterator<int, Command> */
    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->list);
    }
}
