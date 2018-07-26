<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardFactory;

use Aggrego\Domain\Model\InitialBoard\Entity\Board;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Profile;

interface Factory
{
    public function isSupported(Profile $profile): bool;

    public function factory(Key $key, Profile $profile): Board;
}
