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

namespace Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\AggregateEventConsumer\Uuid;

class Command
{
    /** @var Uuid */
    private $boardUuid;

    public function __construct(string $boardUuid)
    {
        $this->boardUuid = new Uuid($boardUuid);
    }

    public function getBoardUuid(): Uuid
    {
        return $this->boardUuid;
    }
}
