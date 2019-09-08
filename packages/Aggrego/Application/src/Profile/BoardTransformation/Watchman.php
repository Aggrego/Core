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

namespace Aggrego\Application\Profile\BoardTransformation;

use Aggrego\Application\Profile\Profile;

interface Watchman
{
    public function isSupported(Profile $profile): bool;

    public function passTransformation(Profile $profile): Transformation;
}
