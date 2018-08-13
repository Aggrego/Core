<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Shard;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\ValueObject\Data;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class FinalItem extends Item
{
    /** @var Data */
    private $data;

    public function __construct(Uuid $uuid, Profile $profile, Data $data)
    {
        parent::__construct($uuid, $profile);
        $this->data = $data;
    }

    public function getData(): Data
    {
        return $this->data;
    }
}
