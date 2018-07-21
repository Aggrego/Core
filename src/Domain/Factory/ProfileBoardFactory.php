<?php

namespace TimiTao\Construo\Domain\Factory;

use Assert\Assertion;
use TimiTao\Construo\Domain\Exception\BoardFactoryNotFoundException;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Profile;

class ProfileBoardFactory
{
    /** @var array */
    private $list;

    public function __construct(array $list)
    {
        Assertion::allImplementsInterface($list, BoardFactory::class);
        $this->list = $list;
    }

    public function factory(Profile $profile): BoardFactory
    {
        $key = (string)$profile;
        if (!isset($this->list[$key])) {
            throw new BoardFactoryNotFoundException();
        }

        return $this->list[$key];
    }
}
