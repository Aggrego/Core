<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Event;

interface Event
{
    public function getName(): string;

    public function getPayload(): array;
}
