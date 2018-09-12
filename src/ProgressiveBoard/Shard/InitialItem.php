<?php

namespace Aggrego\Domain\ProgressiveBoard\Shard;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

class InitialItem extends Item
{
    /** @var Key */
    private $key;

    public function __construct(Profile $profile, Key $key)
    {
        parent::__construct(
            new Uuid(RamseyUuid::uuid4()->toString()),
            $profile
        );
        $this->key = $key;
    }

    public function getKey(): Key
    {
        return $this->key;
    }
}
