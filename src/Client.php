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

namespace Aggrego\CommandLogicUnit;

use Aggrego\CommandConsumer\Client as CommandConsumerClient;
use Aggrego\CommandLogicUnit\CommandConsumer\Collection;
use Aggrego\EventConsumer\Client as EventConsumerClient;
use Aggrego\EventConsumer\Event;
use Aggrego\EventConsumer\Exception\UnprocessableEventException;

class Client implements EventConsumerClient
{
    /** @var EventProcessor[] */
    private $eventProcessors;

    /** @var CommandConsumerClient */
    private $commandConsumer;

    /**
     * @param Event $event
     * @throws UnprocessableEventException if event (payload) have invalid structure.
     */
    public function consume(Event $event): void
    {
        $collection = new Collection();
        foreach ($this->eventProcessors as $eventProcessor) {
            if (!$eventProcessor->isSupported($event)) {
                continue;
            }

            $collection = $collection->merge($eventProcessor->transform($event));
        }

        $this->processCollection($collection);
    }

    private function processCollection(Collection $collection): void
    {
        /** @var CommandProcessor $commandProcessor */
        foreach ($collection as $commandProcessor) {
            $response = $this->commandConsumer->consume($commandProcessor->getCommand());
            $responseCommandsCollection = $commandProcessor->processResponse($response);
            $this->processCollection($responseCommandsCollection);
        }
    }
}
