<?php

declare(strict_types = 1);

namespace Aggrego\EventConsumer;

use Aggrego\EventConsumer\Event\CreatedAt;
use Aggrego\EventConsumer\Event\Domain;
use Aggrego\EventConsumer\Event\Name;
use Aggrego\EventConsumer\Event\Version;

interface Event
{
    public function getDomain(): Domain;

    public function getName(): Name;

    public function createdAt(): CreatedAt;

    public function getVersion(): Version;

    public function getPayload(): array;
}
