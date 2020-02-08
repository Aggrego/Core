<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Event\Shared\Event;

use Aggrego\Infrastructure\Event\CreatedAt as EventCreatedAt;
use DateTimeImmutable;
use Exception;
use TimiTao\ValueObject\Beberlei\Standard\DateFormatValueObject;

class CreatedAt extends DateFormatValueObject implements EventCreatedAt
{
    /**
     * @throws Exception if value is invalid
     */
    protected function guard(DateTimeImmutable $value, string $format): void
    {
        return;
    }
}
