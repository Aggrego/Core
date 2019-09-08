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

namespace Aggrego\Application\Board;

use Aggrego\Application\Board\Prototype\Board as PrototypeBoard;
use Aggrego\Application\Board\Prototype\Metadata;
use Aggrego\Application\Profile\Profile;

interface Builder
{
    public function isSupported(PrototypeBoard $board): bool;

    public function build(Uuid $uuid, Key $key, Profile $profile, Metadata $step, ?Uuid $parentUuid): Board;
}
