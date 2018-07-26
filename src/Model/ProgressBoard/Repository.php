<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Model\ProgressBoard;

use Aggrego\Domain\Model\ProgressBoard\Entity\Board;
use Aggrego\Domain\Model\ProgressBoard\Exception\BoardExistException;
use Aggrego\Domain\Model\ProgressBoard\Exception\BoardNotFoundException;
use Aggrego\Domain\ValueObject\Uuid;

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
