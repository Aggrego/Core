<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Board;

use Aggrego\Domain\Board\Exception\BoardExistException;
use Aggrego\Domain\Board\Exception\BoardNotFoundException;

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
