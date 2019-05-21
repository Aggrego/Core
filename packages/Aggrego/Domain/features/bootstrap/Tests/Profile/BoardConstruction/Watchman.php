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

namespace Tests\Profile\BoardConstruction;

use Aggrego\Domain\Profile\BoardConstruction\Builder as DomainBuilder;
use Aggrego\Domain\Profile\BoardConstruction\Watchman as DomainWatchman;
use Aggrego\Domain\Profile\Profile;
use Tests\Profile\BaseTestWatchman;

class Watchman extends BaseTestWatchman implements DomainWatchman
{
    public function passBuilder(Profile $profile): DomainBuilder
    {
        return new Builder($profile);
    }
}
