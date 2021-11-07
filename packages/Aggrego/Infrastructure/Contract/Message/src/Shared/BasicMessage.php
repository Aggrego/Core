<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Message\Shared;

use Aggrego\Infrastructure\Contract\Message\CorrelatedCommand;
use Aggrego\Infrastructure\Contract\Message\Id;
use Aggrego\Infrastructure\Contract\Message\Message;
use Aggrego\Infrastructure\Contract\Message\Payload;
use Aggrego\Infrastructure\Contract\Message\Sender;

abstract class BasicMessage implements Message
{
    public function __construct(
        private Id $id,
        private Sender $sender,
        private Payload $payload,
        private ?CorrelatedCommand $correlatedCommand,
    )
    {
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function getCorrelatedCommand(): ?CorrelatedCommand
    {
        return $this->correlatedCommand;
    }

    public function getPayload(): Payload
    {
        return $this->payload;
    }
}