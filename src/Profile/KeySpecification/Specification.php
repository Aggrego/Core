<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\KeySpecification;

use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Profile;

interface Specification
{
    public function isSupported(Profile $profile): bool;

    public function isSatisfiedBy(Key $key): bool;
}
