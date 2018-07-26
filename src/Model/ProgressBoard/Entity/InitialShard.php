<?php

namespace Aggrego\Domain\Model\ProgressBoard\Entity;

use Aggrego\Domain\Model\Board\Entity\Shard as BaseShard;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;

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
