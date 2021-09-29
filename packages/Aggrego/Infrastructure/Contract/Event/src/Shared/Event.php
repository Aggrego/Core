<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Event\Shared;

use Aggrego\Infrastructure\Contract\Event\CreatedAt;
use Aggrego\Infrastructure\Contract\Event\Domain;
use Aggrego\Infrastructure\Contract\Event\Event as EventInterface;
use Aggrego\Infrastructure\Contract\Event\Name;
use Aggrego\Infrastructure\Contract\Event\Payload;
use Aggrego\Infrastructure\Contract\Event\Version;

class Event implements EventInterface
{
    public function __construct(
        private Domain $domain,
        private Name $name,
        private CreatedAt $createdAt,
        private Version $version,
        private Payload $data
    ) {
    }

    public function getDomain(): Domain
    {
        return $this->domain;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function createdAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function getVersion(): Version
    {
        return $this->version;
    }

    public function getPayload(): Payload
    {
        return $this->data;
    }
}
