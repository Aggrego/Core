<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\Contract\MessageClient\Shared;

use Aggrego\Infrastructure\Contract\Message\Message;
use Aggrego\Infrastructure\Contract\MessageClient\Client;

class BlankClient implements Client
{
    public function consume(Message $message): void
    {
    }
}
