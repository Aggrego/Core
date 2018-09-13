<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Board;

use Aggrego\Domain\Board\Prototype\Board as PrototypeBoard;
use Aggrego\Domain\Profile\Profile;

interface Builder
{
    public function isSupported(PrototypeBoard $board): bool;

    public function build(Uuid $uuid, Key $key, Profile $profile, Metadata $step, ?Uuid $parentUuid): Board;
}
