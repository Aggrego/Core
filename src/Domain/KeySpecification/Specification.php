<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\KeySpecification;

use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;

interface Specification
{
    public function isSatisfiedBy(Key $key): bool;
}
