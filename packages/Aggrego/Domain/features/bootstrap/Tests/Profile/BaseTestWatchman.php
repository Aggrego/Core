<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace Tests\Profile;

use Aggrego\Domain\Profile\Profile;

abstract class BaseTestWatchman
{
    public const DEFAULT_PROFILE = 'test';
    public const DEFAULT_VERSION = '1.0';

    public function isSupported(Profile $profile): bool
    {
        return $profile->equal(Profile::createFromParts(self::DEFAULT_PROFILE, self::DEFAULT_VERSION));
    }
}
