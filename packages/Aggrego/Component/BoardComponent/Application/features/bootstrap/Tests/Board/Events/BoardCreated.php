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

use Aggrego\Component\BoardComponent\Domain\Board\Id\Id;
use Aggrego\Component\BoardComponent\Domain\Profile\Name as ProfileName;
use Aggrego\Infrastructure\Contract\Event\Shared\Event;
use Aggrego\Infrastructure\Contract\Event\Shared\Event\CreatedAt;
use Aggrego\Infrastructure\Contract\Event\Shared\Event\Domain;
use Aggrego\Infrastructure\Contract\Event\Shared\Event\Name;
use Aggrego\Infrastructure\Contract\Event\Shared\Event\Payload;
use Aggrego\Infrastructure\Contract\Event\Shared\Event\Version;
use DateTimeImmutable;

class BoardCreated extends Event
{
    private const DOMAIN_NAME = 'test.board';

    public static function build(Id $uuid, ProfileName $profileName): self
    {
        return new self(
            Domain::build(
                self::DOMAIN_NAME,
                $uuid->getValue()
            ),
            new Name(self::class),
            new CreatedAt(new DateTimeImmutable()),
            new Version('1.0.0.0'),
            new Payload(
                [
                    'id' => $uuid->getValue(),
                    'profile' => (string) $profileName,
                ]
            )
        );
    }
}
