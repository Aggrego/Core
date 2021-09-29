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

namespace spec\Aggrego\Component\EventProcessorComponent\Application\EventClient;

use Aggrego\Infrastructure\Contract\Command\Command;
use Aggrego\Infrastructure\Contract\CommandClient\Client as CommandClient;
use Aggrego\Infrastructure\Contract\Event\Event;
use Aggrego\Component\EventProcessorComponent\Application\EventProcessor\EventProcessor;
use Aggrego\Component\EventProcessorComponent\Application\Shared\EventProcessor\CommandCollection;
use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{
    function let(
        EventProcessor $eventProcessor,
        CommandClient $commandConsumerClient
    ) {
        $this->beConstructedWith($eventProcessor, $commandConsumerClient);
    }

    function it_should_consume(
        EventProcessor $eventProcessor,
        CommandClient $commandConsumerClient,
        Command $command,
        Event $event
    ) {
        $eventProcessor->transform($event)->willReturn(new CommandCollection($command->getWrappedObject()));
        $this->beConstructedWith($eventProcessor, $commandConsumerClient);

        $this->consume($event)->shouldReturn(null);
    }
}
