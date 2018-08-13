<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard\Events;

use Aggrego\Domain\Profile\Profile;
use Aggrego\Domain\Shared\Event\Model\Events\Event;
use Aggrego\Domain\Shared\ValueObject\Key;
use Aggrego\Domain\Shared\ValueObject\Uuid;

class BoardCreatedEvent extends Event
{
    public function __construct(Uuid $uuid, Key $key, Profile $profile)
    {
        parent::__construct(
            [
                'uuid' => $uuid->getValue(),
                'key' => $key->getValue(),
                'profile' => $profile->__toString()
            ]
        );
    }
}
