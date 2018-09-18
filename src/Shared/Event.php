<?php

declare(strict_types = 1);

namespace Aggrego\EventConsumer\Shared;

use Aggrego\EventConsumer\Event as EventInterface;
use Aggrego\EventConsumer\Event\CreatedAt;
use Aggrego\EventConsumer\Event\Domain;
use Aggrego\EventConsumer\Event\Version;

class Event implements EventInterface
{
    /** @var Domain */
    private $domain;

    /** @var CreatedAt */
    private $createdAt;

    /** @var Version */
    private $version;

    /** @var array */
    private $data;

    public function __construct(Domain $domain, CreatedAt $createdAt, Version $version, array $data)
    {
        $this->domain = $domain;
        $this->createdAt = $createdAt;
        $this->version = $version;
        $this->data = $data;
    }

    public function getDomain(): Domain
    {
        return $this->domain;
    }

    public function createdAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function getVersion(): Version
    {
        return $this->version;
    }

    public function getPayload(): array
    {
        return $this->data;
    }
}
