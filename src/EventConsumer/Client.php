<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Aggrego\CommandLogicUnit\EventConsumer;

use Aggrego\CommandConsumer\Client as CommandConsumerClient;
use Aggrego\CommandLogicUnit\ResponseProcessor\Factory;
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

    /**
     * @var Factory
     */
    private $responseProcessorFactory;

    /**
     * @var EventConsumerClient
     */
    private $eventConsumer;

    public function __construct(
        EventProcessor $eventProcessor,
        CommandConsumerClient $commandConsumer,
        Factory $responseProcessorFactory,
        EventConsumerClient $eventConsumer
    ) {
        $this->eventProcessor = $eventProcessor;
        $this->commandConsumer = $commandConsumer;
        $this->responseProcessorFactory = $responseProcessorFactory;
        $this->eventConsumer = $eventConsumer;
    }

    /**
     * @param  Event $event
     * @throws UnprocessableEventException if event (payload) have invalid structure.
     */
    public function consume(Event $event): void
    {
        foreach ($this->eventProcessor->transform($event) as $command) {
            $response = $this->commandConsumer->consume($command);

            $responseProcessor = $this->responseProcessorFactory->create($command, $response);
            $responseProcessor->processResponse($command, $response);

            foreach ($responseProcessor->pullEvents() as $event) {
                $this->eventConsumer->consume($event);
            }
        }
    }
}
