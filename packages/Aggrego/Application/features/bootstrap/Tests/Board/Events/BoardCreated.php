<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Board\Events;

use Aggrego\Application\Board\Id\Uuid;
use Aggrego\Domain\Profile\Name as ProfileName;
use Aggrego\EventConsumer\Event\CreatedAt;
use Aggrego\EventConsumer\Event\Domain;
use Aggrego\EventConsumer\Event\Name;
use Aggrego\EventConsumer\Event\Version;
use Aggrego\EventConsumer\Shared\Event;
use DateTimeImmutable;

class BoardCreated extends Event
{
    private const DOMAIN_NAME = 'test.board';

    public static function build(Uuid $uuid, ProfileName $profileName): self
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
                'profile' => (string) $profileName,
            ]
        );
    }
}
