<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\Message\Shared\Factory;

use Aggrego\Infrastructure\Contract\Command\Command;
use Aggrego\Infrastructure\Contract\Message\Addressee;
use Aggrego\Infrastructure\Contract\Message\CorrelatedCommand;
use Aggrego\Infrastructure\Contract\Message\Factory\CorrelatedCommandFactory;
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\StringValueObject;

class BasicCorrelatedCommandFactory implements CorrelatedCommandFactory
{
    public function factory(Command $command): CorrelatedCommand
    {
        return new CorrelatedCommand(
            new class ($command->getSender()->getValue()) extends StringValueObject implements Addressee {
            },
            $command->getId()
        );
    }
}
