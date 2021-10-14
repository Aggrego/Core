<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Event\Shared\Event;

use Aggrego\Infrastructure\Contract\Event\Name as EventName;
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\StringValueObject;

class Name extends StringValueObject implements EventName
{
}
