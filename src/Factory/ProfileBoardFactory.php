<?php

namespace Aggrego\Domain\Factory;

use Assert\Assertion;
use Aggrego\Domain\Exception\BoardFactoryNotFoundException;
use Aggrego\Domain\Profile\BoardFactory\Factory;
use Aggrego\Domain\ValueObject\Profile;

class ProfileBoardFactory
{
    /** @var Factory[] */
    private $list;

    public function __construct(array $list)
    {
        Assertion::allImplementsInterface($list, Factory::class);
        $this->list = $list;
    }

    public function factory(Profile $profile): Factory
    {
        foreach ($this->list as $factory) {
            if ($factory->isSupported($profile)) {
                return $factory;
            }
        }
        throw new BoardFactoryNotFoundException();
    }
}
