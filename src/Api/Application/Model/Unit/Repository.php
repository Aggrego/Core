<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Model\Unit;

use Aggrego\Domain\Api\Application\Model\Unit\Exception\UnitExistException;
use Aggrego\Domain\Model\Unit\Unit;
use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Key;

interface Repository
{
    public function findUnit(Key $key, Profile $profile): ?Unit;

    /**
     * @param Unit $unit
     * @throws UnitExistException
     */
    public function addUnit(Unit $unit): void;
}
