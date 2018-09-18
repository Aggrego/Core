<?php

declare(strict_types = 1);

namespace Aggrego\EventConsumer\Api;

use Aggrego\EventConsumer\Event;
use Aggrego\EventConsumer\Exception\UnprocessableEventException;

interface Client
{
    public function isSupported(Event $event): bool;

    /**
     * @param Event $event
     * @throws UnprocessableEventException if event (payload) have invalid structure.
     */
    public function consume(Event $event): void;
}
