<?php

namespace TimiTao\Construo\Domain\Model\ProgressBoard\Entity;

use TimiTao\Construo\Domain\Model\Board\Entity\Shard as BaseShard;
use TimiTao\Construo\Domain\ValueObject\Key;
use TimiTao\Construo\Domain\ValueObject\Source;
use TimiTao\Construo\Domain\ValueObject\Uuid;

class InitialShard extends BaseShard
{
    /** @var Key */
    private $key;

    public function __construct(Uuid $uuid, Source $acceptableSource, Key $key)
    {
        parent::__construct($uuid, $acceptableSource);
        $this->key = $key;
    }

    public function getKey(): Key
    {
        return $this->key;
    }
}
