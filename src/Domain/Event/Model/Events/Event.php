<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Event\Model\Events;

use TimiTao\Construo\Domain\Event\Event as InterfaceEvent;

abstract class Event implements InterfaceEvent
{
    /** @var array */
    private $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function getName(): string
    {
        return static::class;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
