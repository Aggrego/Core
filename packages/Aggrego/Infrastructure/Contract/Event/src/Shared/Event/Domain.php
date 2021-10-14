<?php

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Event\Shared\Event;

use Aggrego\Infrastructure\Contract\Event\Domain as EventDomain;
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\StringValueObject;

class Domain extends StringValueObject implements EventDomain
{
    private const SEPARATOR = ':';

    public static function build(string $domainName, string $key): self
    {
        return new self(sprintf('%s%s%s', $domainName, self::SEPARATOR, $key));
    }
}
