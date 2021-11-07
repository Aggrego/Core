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

use Aggrego\Infrastructure\Contract\Message\Factory\SenderFactory;
use Aggrego\Infrastructure\Contract\Message\Sender;
use TimiTao\ValueObject\Standard\Required\AbstractClass\ValueObject\StringValueObject;

class ConstSenderFactory implements SenderFactory
{
    public function __construct(
        private string $sender
    ) {
    }

    public function factory(): Sender
    {
        return new class ($this->sender) extends StringValueObject implements Sender {
        };
    }
}
