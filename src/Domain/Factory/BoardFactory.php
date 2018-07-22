<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Factory;

use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;

interface BoardFactory
{
    public function factory(Key $key, Profile $profile): Board;
}
