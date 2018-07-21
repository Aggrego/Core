<?php

declare(strict_types = 1);

namespace TimiTao\Construo\Domain\Model\Board;

use TimiTao\Construo\Domain\Model\Board\Entity\Board;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;

interface Repository
{
    public function findBoard(Key $key): ?Board;

    public function addBoard(Board $board): void;
}
