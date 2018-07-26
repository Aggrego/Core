<?php

namespace Aggrego\Domain\Factory;

use Assert\Assertion;
use Aggrego\Domain\Exception\BoardTransformationNotFoundException;
use Aggrego\Domain\Profile\BoardTransformation\Transformation;
use Aggrego\Domain\ValueObject\Profile;

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
