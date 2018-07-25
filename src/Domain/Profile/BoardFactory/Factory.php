<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Profile\BoardFactory;

use TimiTao\Construo\Domain\Model\InitialBoard\Entity\Board;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;

interface Factory
{
    public function isSupported(Profile $profile): bool;

    public function factory(Key $key, Profile $profile): Board;
}
