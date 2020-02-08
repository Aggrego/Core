<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\DataDomainBoard\Board\Events;

use Aggrego\DataDomainBoard\Board\Data;
use Aggrego\Domain\Board\Id\Id;
use Aggrego\Domain\Profile\Name as ProfileName;
use Aggrego\Infrastructure\Event\Shared\Event;
use Aggrego\Infrastructure\Event\Shared\Event\CreatedAt;
use Aggrego\Infrastructure\Event\Shared\Event\Domain;
use Aggrego\Infrastructure\Event\Shared\Event\Name;
use Aggrego\Infrastructure\Event\Shared\Event\Payload;
use Aggrego\Infrastructure\Event\Shared\Event\Version;
use DateTimeImmutable;

class BoardCreatedEvent extends Event
{
    private const DOMAIN_NAME = 'board.data_board';

    public static function build(
        Id $id,
        ProfileName $profileName,
        Data $data,
        ?Id $parentId
    ): self {
        return new self(
            new Domain(self::DOMAIN_NAME, $id->getValue()),
            new Name(self::class),
            new CreatedAt(new DateTimeImmutable()),
            Version::normalize('1.0.0.0'),
            new Payload(
                [
                    'id' => $id->getValue(),
                    'profile' => [
                        'name' => $profileName->getName(),
                        'version' => $profileName->getVersion(),
                    ],
                    'parent_id' => $parentId ? $parentId->getValue() : null,
                    'data' => $data->getValue(),
                ]
            )
        );
    }
}
