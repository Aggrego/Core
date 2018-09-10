<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Shared\Event\Model\Events;

use Aggrego\EventStore\Event as EventInterface;
use DateTimeImmutable;

abstract class Event implements EventInterface
{
    private const DEFAULT_VERSION = '1.0.0';

    /** @var array */
    private $payload;

    /** @var EventInterface\Version */
    private $version;

    /** @var EventInterface\CreatedAt */
    private $createdAt;

    public function __construct(array $payload, string $version = self::DEFAULT_VERSION)
    {
        $this->payload = $payload;
        $this->version = new EventInterface\Version($version);
        $this->createdAt = new EventInterface\CreatedAt(new DateTimeImmutable());
    }

    public function getName(): EventInterface\Name
    {
        return new EventInterface\Name(static::class);
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getVersion(): EventInterface\Version
    {
        return $this->version;
    }

    public function createdAt(): EventInterface\CreatedAt
    {
        return $this->createdAt;
    }
}
