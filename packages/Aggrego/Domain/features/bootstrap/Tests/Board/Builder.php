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

namespace Tests\Board;

use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Builder as DomainBuilder;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Prototype\Board as PrototypeBoard;
use Aggrego\Domain\Board\Prototype\Metadata;
use Aggrego\Domain\Board\Uuid;
use Aggrego\Domain\Profile\Profile;
use Tests\Board\Board as TestsBoard;
use Tests\Board\Prototype\Board as TestsPrototypeBoard;

class Builder implements DomainBuilder
{
    public function isSupported(PrototypeBoard $board): bool
    {
        return $board instanceof TestsPrototypeBoard;
    }

    public function build(Uuid $uuid, Key $key, Profile $profile, Metadata $step, ?Uuid $parentUuid): Board
    {
        return new TestsBoard($uuid, $profile);
    }
}
