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

namespace spec\Aggrego\CommandLogicUnit\EventConsumer;

use Aggrego\CommandConsumer\Client as CommandConsumerClient;
use Aggrego\CommandConsumer\Command;
use Aggrego\CommandLogicUnit\EventConsumer\Client;
use Aggrego\CommandLogicUnit\EventProcessor\EventProcessor;
use Aggrego\CommandLogicUnit\Shared\EventProcessor\CommandCollection;
use Aggrego\EventConsumer\Shared\Event;
use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{
    function let(
        EventProcessor $eventProcessor,
        CommandConsumerClient $commandConsumerClient
    )
    {
        $this->beConstructedWith($eventProcessor, $commandConsumerClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }

    function it_should_consume(
        EventProcessor $eventProcessor,
        CommandConsumerClient $commandConsumerClient,
        Command $command,
        Event $event
    )
    {
        $eventProcessor->transform($event)->willReturn(new CommandCollection($command->getWrappedObject()));
        $this->beConstructedWith($eventProcessor, $commandConsumerClient);

        $this->consume($event)->shouldReturn(null);
    }
}
