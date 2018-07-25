<?php

declare(strict_types = 1);

namespace Tests\Domain\Model\Unit;

use TimiTao\Construo\Domain\Model\Unit\Entity\Unit;
use TimiTao\Construo\Domain\Model\Unit\Repository as UnitRepository;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Profile;

class Repository implements UnitRepository
{
    /** @var array */
    private $list;

    public function __construct()
    {
        $this->clear();
    }

    public function clear(): void
    {
        $this->list = [];
    }

    public function getList(): array
    {
        return $this->list;
    }

    public function findUnit(Key $key, Profile $profile): ?Unit
    {
        if (!isset($this->list[serialize($key->getValue())])) {
            return null;
        }
        return $this->list[serialize($key->getValue())];
    }

    public function addUnit(Unit $unit): void
    {
        $this->list[serialize($unit->getKey()->getValue())] = $unit;
    }
}
