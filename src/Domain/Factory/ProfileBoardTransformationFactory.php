<?php

namespace TimiTao\Construo\Domain\Factory;

use Assert\Assertion;
use TimiTao\Construo\Domain\BoardTransformation\Transformation;
use TimiTao\Construo\Domain\Exception\BoardTransformationNotFoundException;
use TimiTao\Construo\Domain\ValueObject\Profile;

class ProfileBoardTransformationFactory
{
    /** @var array */
    private $list;

    public function __construct(array $list)
    {
        Assertion::allImplementsInterface($list, Transformation::class);
        $this->list = $list;
    }

    public function factory(Profile $profile): Transformation
    {
        $key = (string)$profile;
        if (!isset($this->list[$key])) {
            throw new BoardTransformationNotFoundException();
        }

        return $this->list[$key];
    }
}
