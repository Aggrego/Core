<?php
/**
 *
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace Aggrego\DataDomainBoard\Board\Events;

use Aggrego\DataDomainBoard\Board\Prototype\Metadata;
use Aggrego\Domain\Board\Key;
use Aggrego\Domain\Board\Uuid;
use Aggrego\Domain\Profile\Profile;
use Aggrego\EventConsumer\Event\CreatedAt;
use Aggrego\EventConsumer\Event\Domain;
use Aggrego\EventConsumer\Event\Name;
use Aggrego\EventConsumer\Event\Version;
use Aggrego\EventConsumer\Shared\Event;
use DateTimeImmutable;

class BoardCreatedEvent extends Event
{
    private const DOMAIN_NAME = 'board.data_board';

    public static function build(Uuid $uuid, Key $key, Profile $profile, Metadata $metadata, ?Uuid $parentUuid): self
    {
        return new self(
            Domain::build(
                self::DOMAIN_NAME,
                $uuid->getValue()
            ),
            new Name(self::class),
            new CreatedAt(new DateTimeImmutable()),
            new Version('1.0.0.0'),
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
