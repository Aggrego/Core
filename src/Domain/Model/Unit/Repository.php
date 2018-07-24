<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Model\Unit;

use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;

interface Repository
{
    public function findUnit(Key $key, Profile $profile): ?Unit;

    public function addUnit(Unit $unit): void;
}
