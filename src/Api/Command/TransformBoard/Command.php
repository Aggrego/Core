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
use Aggrego\Domain\Board\Key;

class Command
{
    /** @var Uuid */
    private $boardUuid;

    /** @var Key */
    private $key;

    public function __construct(string $boardUuid, array $key)
    {
        $this->boardUuid = new Uuid($boardUuid);
        $this->key = new Key($key);
    }

    public function getBoardUuid(): Uuid
    {
        return $this->boardUuid;
    }

    public function getKey(): Key
    {
        return $this->key;
    }
}
