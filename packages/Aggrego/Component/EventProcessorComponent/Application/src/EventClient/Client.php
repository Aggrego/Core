<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\EventProcessorComponent\Application\EventClient;

use Aggrego\Component\EventProcessorComponent\Application\EventProcessor\EventProcessor;
use Aggrego\Infrastructure\Contract\CommandClient\Client as CommandClient;
use Aggrego\Infrastructure\Contract\Event\Event;
use Aggrego\Infrastructure\Contract\EventClient\Client as EventClient;

class Client implements EventClient
{
    public function __construct(
        private EventProcessor $eventProcessor,
        private CommandClient $commandClient
    ) {
    }

    public function consume(Event $event): void
    {
        foreach ($this->eventProcessor->transform($event) as $command) {
            $this->commandClient->consume($command);
        }
    }
}
