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

namespace Aggrego\CommandLogicUnit\ResponseProcessor;

use Aggrego\CommandConsumer\Command;
use Aggrego\CommandConsumer\Response;
use Aggrego\EventConsumer\Shared\Events;

interface ResponseProcessor
{
    public function processResponse(Command $command, Response $response): void;

    public function pullEvents(): Events;
}
