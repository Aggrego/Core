<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Shared\Event\Model\Events;

use Aggrego\Domain\Api\Application\Event\Event as EventInterface;

abstract class Event implements EventInterface
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
