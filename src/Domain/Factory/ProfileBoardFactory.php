<?php

namespace TimiTao\Construo\Domain\Factory;

use Assert\Assertion;
use TimiTao\Construo\Domain\Exception\BoardFactoryNotFoundException;
use TimiTao\Construo\Domain\Profile\BoardFactory\Factory;
use TimiTao\Construo\Domain\ValueObject\Profile;

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
