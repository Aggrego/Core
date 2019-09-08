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

use Aggrego\Application\Board\Board;
use Aggrego\Application\Board\Builder as DomainBuilder;
use Aggrego\Application\Board\Key;
use Aggrego\Application\Board\Prototype\Board as PrototypeBoard;
use Aggrego\Application\Board\Prototype\Metadata;
use Aggrego\Application\Board\Uuid;
use Aggrego\Application\Profile\Profile;
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
