<?php

namespace Aggrego\Domain\Model\InitialBoard\Entity;

use Aggrego\Domain\Model\Board\Entity\Shard as BaseShard;
use Aggrego\Domain\ValueObject\Key;
use Aggrego\Domain\ValueObject\Source;
use Aggrego\Domain\ValueObject\Uuid;

class Shard extends BaseShard
{
    /** @var Key */
    private $key;

    public function __construct(Uuid $uuid, Source $source, Key $key)
    {
        parent::__construct($uuid, $source);
        $this->key = $key;
    }

    public function getKey(): Key
    {
        return $this->key;
    }
}
