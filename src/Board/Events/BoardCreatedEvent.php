<?php

declare(strict_types = 1);

namespace Aggrego\DataBoard\Board\Events;

use Aggrego\DataBoard\Board\Metadata;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Profile\Profile;
use Aggrego\EventStore\Shared\Event\Model\Events\Event;
use Aggrego\EventStore\Uuid;

class BoardCreatedEvent extends Event
{
    public function __construct(Uuid $uuid, Key $key, Profile $profile, Metadata $metadata, ?Uuid $parentUuid)
    {
        parent::__construct(
            [
                'uuid' => $uuid->getValue(),
                'key' => $key->getValue(),
                'profile' => $profile->__toString(),
                'metadata' => $metadata->getData()->getValue(),
                'parent_uuid' => $parentUuid ? $parentUuid->getValue() : null,
            ]
        );
    }
}
