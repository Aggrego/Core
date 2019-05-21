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

namespace Aggrego\EventConsumer\Shared;

use Aggrego\EventConsumer\Event as EventInterface;
use Aggrego\EventConsumer\Event\CreatedAt;
use Aggrego\EventConsumer\Event\Domain;
use Aggrego\EventConsumer\Event\Name;
use Aggrego\EventConsumer\Event\Version;

class Event implements EventInterface
{
    /**
     * @var Domain
     */
    private $domain;

    /**
     * @var Name
     */
    private $name;

    /**
     * @var CreatedAt
     */
    private $createdAt;

    /**
     * @var Version
     */
    private $version;

    /**
     * @var array
     */
    private $data;

    public function __construct(Domain $domain, Name $name, CreatedAt $createdAt, Version $version, array $data)
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

    public function getPayload(): array
    {
        return $this->data;
    }
}
