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

namespace Aggrego\CommandLogicUnit\EventConsumer;

use Aggrego\CommandConsumer\Client as CommandConsumerClient;
use Aggrego\CommandLogicUnit\EventProcessor\EventProcessor;
use Aggrego\EventConsumer\Client as EventConsumerClient;
use Aggrego\EventConsumer\Event;
use Aggrego\EventConsumer\Exception\UnprocessableEventException;

class Client implements EventConsumerClient
{
    /**
     * @var EventProcessor
     */
    private $eventProcessor;

    /**
     * @var CommandConsumerClient
     */
    private $commandConsumer;

    public function __construct(
        EventProcessor $eventProcessor,
        CommandConsumerClient $commandConsumer
    ) {
        $this->eventProcessor = $eventProcessor;
        $this->commandConsumer = $commandConsumer;
    }

    /**
     * @param  Event $event
     * @throws UnprocessableEventException if event (payload) have invalid structure.
     */
    public function consume(Event $event): void
    {
        foreach ($this->eventProcessor->transform($event) as $command) {
            $this->commandConsumer->consume($command);
        }
    }
}
