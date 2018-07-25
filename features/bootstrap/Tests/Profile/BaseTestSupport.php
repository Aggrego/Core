<?php

declare(strict_types = 1);

namespace Tests\Profile;

use TimiTao\Construo\Domain\ValueObject\Profile;

abstract class BaseTestSupport
{
    public const DEFAULT_PROFILE = 'test';
    public const DEFAULT_VERSION = '1.0';

    public function isSupported(Profile $profile): bool
    {
        return $profile->getName()->getValue() === self::DEFAULT_PROFILE
            && $profile->getVersion()->getValue() === self::DEFAULT_VERSION;
    }
}
