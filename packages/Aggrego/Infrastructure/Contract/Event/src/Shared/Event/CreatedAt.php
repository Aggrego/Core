<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Event\Shared\Event;

use Aggrego\Infrastructure\Contract\Event\CreatedAt as EventCreatedAt;
use TimiTao\ValueObject\Standard\Required\AbstractClass\DateTime\DateFormatValueObject;

class CreatedAt extends DateFormatValueObject implements EventCreatedAt
{
}
