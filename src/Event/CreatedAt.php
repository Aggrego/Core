<?php

declare(strict_types = 1);

namespace Aggrego\EventConsumer\Event;

use DateTimeImmutable;
use TimiTao\ValueObject\Utils\TimestampValueObject;

class CreatedAt extends TimestampValueObject
{
    public function __construct(DateTimeImmutable $dateTimeImmutable)
    {
        parent::__construct(self::class, $dateTimeImmutable);
    }
}
