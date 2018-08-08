<?php

namespace Aggrego\Domain\Model\ProgressiveBoard\Shard;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class InitialItem extends Item
{
    /** @var Key */
    private $key;

    public function __construct(Uuid $uuid, Profile $profile, Key $key)
    {
        parent::__construct($uuid, $profile);
        $this->key = $key;
    }

    public function getKey(): Key
    {
        return $this->key;
    }
}
