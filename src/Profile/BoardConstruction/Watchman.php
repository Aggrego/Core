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

namespace Aggrego\Domain\Profile\BoardConstruction;

use Aggrego\Domain\Profile\Profile;

interface Watchman
{
    public function isSupported(Profile $profile): bool;

    public function passBuilder(Profile $profile): Builder;
}
