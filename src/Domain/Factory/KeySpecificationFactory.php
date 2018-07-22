<?php

namespace TimiTao\Construo\Domain\Factory;

use Assert\Assertion;
use TimiTao\Construo\Domain\Exception\KeySpecificationNotFoundException;
use TimiTao\Construo\Domain\KeySpecification\Specification;
use TimiTao\Construo\Domain\ValueObject\Profile;

class KeySpecificationFactory
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
        $key = (string)$profile;
        if (!isset($this->list[$key])) {
            throw new KeySpecificationNotFoundException();
        }

        return $this->list[$key];
    }
}
