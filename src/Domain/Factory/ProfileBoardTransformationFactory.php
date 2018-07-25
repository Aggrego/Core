<?php

namespace TimiTao\Construo\Domain\Factory;

use Assert\Assertion;
use TimiTao\Construo\Domain\Exception\BoardTransformationNotFoundException;
use TimiTao\Construo\Domain\Profile\BoardTransformation\Transformation;
use TimiTao\Construo\Domain\ValueObject\Profile;

class ProfileBoardTransformationFactory
{
    /** @var Transformation[] */
    private $list;

    public function __construct(array $list)
    {
        Assertion::allImplementsInterface($list, Transformation::class);
        $this->list = $list;
    }

    public function factory(Profile $profile): Transformation
    {
        foreach ($this->list as $factory) {
            if ($factory->isSupported($profile)) {
                return $factory;
            }
        }
        throw new BoardTransformationNotFoundException();
    }
}
