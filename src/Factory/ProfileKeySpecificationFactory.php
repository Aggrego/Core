<?php

namespace Aggrego\Domain\Factory;

use Assert\Assertion;
use Aggrego\Domain\Exception\KeySpecificationNotFoundException;
use Aggrego\Domain\Profile\KeySpecification\Specification;
use Aggrego\Domain\ValueObject\Profile;

class ProfileKeySpecificationFactory
{
    /** @var array */
    private $list;

    public function __construct(array $list)
    {
        Assertion::allImplementsInterface($list, Specification::class);
        $this->list = $list;
    }

    public function factory(Profile $profile): Specification
    {
        foreach ($this->list as $factory) {
            if ($factory->isSupported($profile)) {
                return $factory;
            }
        }
        throw new KeySpecificationNotFoundException();
    }
}
