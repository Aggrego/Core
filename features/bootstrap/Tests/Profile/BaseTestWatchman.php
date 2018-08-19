<?php

declare(strict_types = 1);

namespace Tests\Profile;

use Aggrego\Domain\Profile\Profile;

abstract class BaseTestWatchman
{
    public const DEFAULT_PROFILE = 'test';
    public const DEFAULT_VERSION = '1.0';

    public function isSupported(Profile $profile): bool
    {
        return $profile->equal(Profile::createFrom(self::DEFAULT_PROFILE, self::DEFAULT_VERSION));
    }
}
