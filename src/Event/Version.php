<?php

declare(strict_types = 1);

namespace Aggrego\EventConsumer\Event;

use Assert\Assertion;
use Composer\Semver\VersionParser;
use TimiTao\ValueObject\Utils\StringValueObject;

class Version extends StringValueObject
{
    public function __construct(string $value)
    {
        Assertion::regex($value, '~^([0-9]+\.{0,1})+$~');
        $normalized = (new VersionParser())->normalize($value);
        parent::__construct(self::class, $normalized);
    }
}
