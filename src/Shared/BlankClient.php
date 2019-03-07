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

use Aggrego\EventConsumer\Client;
use Aggrego\EventConsumer\Event;
use Aggrego\EventConsumer\Exception\UnprocessableEventException;

/**
 * Class BlankClient
 */
class BlankClient implements Client
{
    /**
     * @param  Event $event
     * @throws UnprocessableEventException if event (payload) have invalid structure.
     */
    public function consume(Event $event): void
    {
    }
}
