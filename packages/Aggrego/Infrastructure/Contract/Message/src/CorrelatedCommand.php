<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Message;

use Aggrego\Infrastructure\Contract\Command\Id as CommandId;

final class CorrelatedCommand
{
    public function __construct(
        private Addressee $addressee,
        private CommandId $commandId
    )
    {
    }

    public function getAddressee(): Addressee
    {
        return $this->addressee;
    }

    public function getCommandId(): CommandId
    {
        return $this->commandId;
    }
}
