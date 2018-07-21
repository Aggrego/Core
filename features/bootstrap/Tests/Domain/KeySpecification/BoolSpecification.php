<?php

declare(strict_types = 1);

namespace Tests\Domain\KeySpecification;

use TimiTao\Construo\Domain\KeySpecification\Specification;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;

class BoolSpecification implements Specification
{
    /** @var bool */
    private $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function isSatisfiedBy(Key $key): bool
    {
        return $this->value;
    }
}
