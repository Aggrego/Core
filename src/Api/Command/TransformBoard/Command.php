<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Api\Command\TransformBoard;

use Aggrego\Domain\Board\Uuid;

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
