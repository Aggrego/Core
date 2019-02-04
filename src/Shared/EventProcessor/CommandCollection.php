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

namespace Aggrego\CommandLogicUnit\Shared\EventProcessor;

use Aggrego\CommandConsumer\Command;
use Aggrego\CommandLogicUnit\EventProcessor\CommandCollection as CommandCollectionInterface;
use ArrayIterator;
use Iterator;
use IteratorAggregate;

class CommandCollection implements IteratorAggregate, CommandCollectionInterface
{
    /**
     * @var Command[]
     */
    private $commands;

    public function __construct(Command ...$commands)
    {
        $this->commands = $commands;
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->commands);
    }
}
