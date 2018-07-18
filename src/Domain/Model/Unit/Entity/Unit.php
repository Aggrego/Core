<?php

namespace TimiTao\Construo\Domain\Model\Unit\Entity;

use TimiTao\Construo\Domain\Model\Unit\ValueObject\Key;

class Unit
{
    /** @var Key */
    private $key;

    public function __construct(Key $key)
    {
        $this->key = $key;
    }

    public function getKey(): Key
    {
        return $this->key;
    }
}
