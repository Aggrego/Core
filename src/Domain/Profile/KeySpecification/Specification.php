<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Profile\KeySpecification;

use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;

interface Specification
{
    public function isSupported(Profile $profile): bool;

    public function isSatisfiedBy(Key $key): bool;
}
