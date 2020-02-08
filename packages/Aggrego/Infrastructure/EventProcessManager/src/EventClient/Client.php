<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\EventProcessManager\EventClient;

use Aggrego\Infrastructure\CommandClient\Client as CommandClient;
use Aggrego\Infrastructure\Event\Event;
use Aggrego\Infrastructure\EventClient\Client as EventClient;
use Aggrego\Infrastructure\EventProcessManager\EventProcessor\EventProcessor;

class Client implements EventClient
{
    /**
     * @var EventProcessor
     */
    private $eventProcessor;

    /**
     * @var CommandClient
     */
    private $commandClient;

    public function __construct(
        EventProcessor $eventProcessor,
        CommandClient $commandClient
    ) {
        $this->eventProcessor = $eventProcessor;
        $this->commandClient = $commandClient;
    }

    public function consume(Event $event): void
    {
        foreach ($this->eventProcessor->transform($event) as $command) {
            $this->commandClient->consume($command);
        }
    }
}
