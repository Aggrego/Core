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

namespace spec\Aggrego\Infrastructure\EventProcessManager\EventClient;

use Aggrego\Infrastructure\Command\Command;
use Aggrego\Infrastructure\CommandClient\Client as CommandClient;
use Aggrego\Infrastructure\Event\Event;
use Aggrego\Infrastructure\EventProcessManager\EventProcessor\EventProcessor;
use Aggrego\Infrastructure\EventProcessManager\Shared\EventProcessor\CommandCollection;
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
