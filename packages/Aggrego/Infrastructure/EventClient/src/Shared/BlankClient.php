<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Infrastructure\EventClient\Shared;

use Aggrego\Infrastructure\Event\Event;
use Aggrego\Infrastructure\EventClient\Client;

class BlankClient implements Client
{
    public function consume(Event $event): void
    {
    }
}
