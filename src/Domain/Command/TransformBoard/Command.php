<?php

namespace TimiTao\Construo\Domain\Command\TransformBoard;

class Command
{
    /** @var string */
    private $boardUuid;

    public function __construct(string $boardUuid)
    {
        $this->boardUuid = $boardUuid;
    }

    public function getBoardUuid(): string
    {
        return $this->boardUuid;
    }
}
