<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Aggrego\CommandLogicUnit\ResponseProcessor;

use Aggrego\CommandConsumer\Command;
use Aggrego\CommandConsumer\Response;
use Aggrego\CommandLogicUnit\ResponseProcessor\Exception\CouldNotFoundCorrespondResponseProcessorException;

interface Factory
{
    /**
     * @param  Command  $command
     * @param  Response $response
     * @return ResponseProcessor
     * @throws CouldNotFoundCorrespondResponseProcessorException
     */
    public function create(Command $command, Response $response): ResponseProcessor;
}
