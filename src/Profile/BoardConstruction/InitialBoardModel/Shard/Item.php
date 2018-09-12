<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Profile\BoardConstruction\InitialBoardModel\Shard;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Key;

class Item
{
    /** @var Profile */
    private $profile;

    /** @var Key */
    private $key;

    public function __construct(Profile $profile, Key $key)
    {
        $this->profile = $profile;
        $this->key = $key;
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
