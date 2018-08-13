<?php

declare(strict_types = 1);

namespace Aggrego\Domain\ProgressiveBoard;

use Aggrego\Domain\ProgressiveBoard\Exception\BoardExistException;
use Aggrego\Domain\ProgressiveBoard\Exception\BoardNotFoundException;
use Aggrego\Domain\Shared\ValueObject\Uuid;

interface Repository
{
    /**
     * @param Uuid $uuid
     * @return Board
     * @throws BoardNotFoundException
     */
    public function getBoardByUuid(Uuid $uuid): Board;

    /**
     * @param Board $board
     * @throws BoardExistException
     */
    public function addBoard(Board $board): void;
}
