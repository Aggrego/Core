<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Shard;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Uuid;

abstract class Item
{
    /** @var Uuid */
    private $uuid;

    /** @var Profile */
    private $profile;

    public function __construct(Uuid $uuid, Profile $profile)
    {
        $this->uuid = $uuid;
        $this->profile = $profile;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }
}
