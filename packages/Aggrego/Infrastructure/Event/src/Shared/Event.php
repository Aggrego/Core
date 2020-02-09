<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Aggrego\Infrastructure\Event\Shared;

use Aggrego\Infrastructure\Event\CreatedAt;
use Aggrego\Infrastructure\Event\Domain;
use Aggrego\Infrastructure\Event\Event as EventInterface;
use Aggrego\Infrastructure\Event\Name;
use Aggrego\Infrastructure\Event\Payload;
use Aggrego\Infrastructure\Event\Version;

class Event implements EventInterface
{
    private $domain;

    private $name;

    private $createdAt;

    private $version;

    private $data;

    public function __construct(Domain $domain, Name $name, CreatedAt $createdAt, Version $version, Payload $data)
    {
        $this->domain = $domain;
        $this->createdAt = $createdAt;
        $this->version = $version;
        $this->data = $data;
        $this->name = $name;
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
