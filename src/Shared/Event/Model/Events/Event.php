<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Shared\Event\Model\Events;

use Aggrego\Domain\Api\Application\Event\Event as EventInterface;
use DateTime;

abstract class Event implements EventInterface
{
    private const DEFAULT_VERSION = '1.0.0';

    /** @var array */
    private $payload;

    /** @var string */
    private $version;

    /** @var DateTime */
    private $createdAt;

    public function __construct(array $payload, string $version = self::DEFAULT_VERSION)
    {
        $this->payload = $payload;
        $this->version = $version;
        $this->createdAt = new DateTime();
    }

    public function getName(): string
    {
        return static::class;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function createdAt(): string
    {
        return $this->createdAt->format(DateTime::ATOM);
    }
}
