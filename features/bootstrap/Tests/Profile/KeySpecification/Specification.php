<?php

declare(strict_types = 1);

namespace Tests\Profile\KeySpecification;

use TimiTao\Construo\Domain\KeySpecification\Specification as DomainSpecification;
use TimiTao\Construo\Domain\ValueObject\Key;

class Specification implements DomainSpecification
{
    public function isSatisfiedBy(Key $key): bool
    {
        return array_key_exists('key', $key->getValue());
    }
}
