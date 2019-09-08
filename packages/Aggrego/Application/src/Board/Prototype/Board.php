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

namespace Aggrego\Application\Board\Prototype;

use Aggrego\Application\Board\Key;
use Aggrego\Application\Profile\Profile;

interface Board
{
    public function getKey(): Key;

    public function getProfile(): Profile;

    public function getMetadata(): Metadata;
}
