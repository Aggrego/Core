<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Model\ProgressBoard;

use TimiTao\Construo\Domain\Model\ProgressBoard\Entity\Board;
use TimiTao\Construo\Domain\Model\ProgressBoard\Exception\BoardNotFoundException;
use TimiTao\Construo\Domain\ValueObject\Uuid;

interface Repository
{
    /**
     * @param Uuid $uuid
     * @return Board
     * @throws BoardNotFoundException
     */
    public function getBoardByUuid(Uuid $uuid): Board;

    public function addBoard(Board $board): void;
}
