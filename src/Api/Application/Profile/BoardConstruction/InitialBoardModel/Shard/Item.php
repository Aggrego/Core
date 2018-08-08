<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Application\Profile\BoardConstruction\InitialBoardModel\Shard;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class Item
{
    /** @var Uuid */
    private $uuid;

    /** @var Profile */
    private $profile;

    /** @var Key */
    private $key;

    public function __construct(Uuid $uuid, Profile $profile, Key $key)
    {
        $this->uuid = $uuid;
        $this->profile = $profile;
        $this->key = $key;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function getKey(): Key
    {
        return $this->key;
    }
}
