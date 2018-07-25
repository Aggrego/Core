<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Event;

interface Event
{
    public function getName(): string;

    public function getPayload(): array;
}
