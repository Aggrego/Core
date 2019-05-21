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

namespace Aggrego\Domain\Board;

use Aggrego\Domain\Board\Prototype\Board as PrototypeBoard;
use Aggrego\Domain\Board\Prototype\Metadata;
use Aggrego\Domain\Profile\Profile;

interface Builder
{
    public function isSupported(PrototypeBoard $board): bool;

    public function build(Uuid $uuid, Key $key, Profile $profile, Metadata $step, ?Uuid $parentUuid): Board;
}
