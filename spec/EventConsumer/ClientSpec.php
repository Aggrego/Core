<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace spec\Aggrego\CommandLogicUnit\EventConsumer;

use Aggrego\CommandConsumer\Client as CommandConsumerClient;
use Aggrego\CommandLogicUnit\EventConsumer\Client;
use Aggrego\CommandLogicUnit\EventProcessor\EventProcessor;
use Aggrego\CommandLogicUnit\ResponseProcessor\Factory;
use Aggrego\EventConsumer\Client as EventConsumerClient;
use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{
    function let(
        EventProcessor $eventProcessor,
        CommandConsumerClient $commandConsumerClient,
        Factory $factory,
        EventConsumerClient $eventConsumerClient
    ) {
        $this->beConstructedWith($eventProcessor, $commandConsumerClient, $factory, $eventConsumerClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Client::class);
    }
}
