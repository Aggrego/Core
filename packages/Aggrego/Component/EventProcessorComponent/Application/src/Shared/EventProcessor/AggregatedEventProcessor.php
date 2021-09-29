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

use Aggrego\Component\EventProcessorComponent\Application\EventProcessor\CommandCollection;
use Aggrego\Component\EventProcessorComponent\Application\EventProcessor\EventProcessor;
use Aggrego\Component\EventProcessorComponent\Application\Shared\EventProcessor\CommandCollection as
    SharedCommandCollection;
use Aggrego\Infrastructure\Contract\Event\Event;

class AggregatedEventProcessor implements EventProcessor
{
    /** @var array<int,EventProcessor> $list */
    private array $list;

    /** @param array<int,EventProcessor> $list */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function transform(Event $event): CommandCollection
    {
        $list = [];
        foreach ($this->list as $processor) {
            $list = array_merge($list, iterator_to_array($processor->transform($event)));
        }

        return new SharedCommandCollection(...$list);
    }
}
