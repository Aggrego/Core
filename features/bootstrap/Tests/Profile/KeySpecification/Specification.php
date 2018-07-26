<?php

declare(strict_types = 1);

namespace Tests\Profile\KeySpecification;

use Tests\Profile\BaseTestSupport;
use Aggrego\Domain\Profile\KeySpecification\Specification as DomainSpecification;
use Aggrego\Domain\ValueObject\Key;

class Specification extends BaseTestSupport implements DomainSpecification
{
    public const DEFAULT_KEY = ['key' => 'init'];

    public function isSatisfiedBy(Key $key): bool
    {
        return array_key_exists('key', $key->getValue());
    }
}
