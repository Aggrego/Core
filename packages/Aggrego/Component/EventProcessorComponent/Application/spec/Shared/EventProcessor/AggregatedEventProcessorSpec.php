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

declare(strict_types=1);

namespace spec\Aggrego\Component\EventProcessorComponent\Application\Shared\EventProcessor;

use Aggrego\Component\EventProcessorComponent\Application\EventProcessor\CommandCollection;
use Aggrego\Component\EventProcessorComponent\Application\EventProcessor\EventProcessor;
use Aggrego\Component\EventProcessorComponent\Application\Shared\EventProcessor\CommandCollection as
    SharedCommandCollection;
use Aggrego\Infrastructure\Contract\Command\Command;
use Aggrego\Infrastructure\Contract\Event\Event;
use PhpSpec\ObjectBehavior;

class AggregatedEventProcessorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([]);
    }

    function it_should_return_empty_collection(Event $event)
    {
        $this->transform($event)
            ->shouldBeAnInstanceOf(CommandCollection::class);
    }

    function it_should_return_collection(EventProcessor $eventProcessor, Command $command, Event $event)
    {
        $eventProcessor
            ->transform($event->getWrappedObject())
            ->willReturn(new SharedCommandCollection($command->getWrappedObject()));

        $this->beConstructedWith([$eventProcessor]);

        $this->transform($event)
            ->shouldHaveCount(1);
    }
}
