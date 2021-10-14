<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Event\Shared\Event;

use Aggrego\Infrastructure\Contract\Event\Payload as EventPayload;
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\ArrayValueObject;

class Payload extends ArrayValueObject implements EventPayload
{
}
