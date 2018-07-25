<?php

namespace TimiTao\Construo\Domain\Factory;

use Assert\Assertion;
use TimiTao\Construo\Domain\Exception\KeySpecificationNotFoundException;
use TimiTao\Construo\Domain\Profile\KeySpecification\Specification;
use TimiTao\Construo\Domain\ValueObject\Profile;

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
