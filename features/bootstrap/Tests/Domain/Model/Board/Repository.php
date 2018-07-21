<?php

declare(strict_types = 1);

namespace Tests\Domain\Model\Board;

use TimiTao\Construo\Domain\Model\Board\Entity\Board;
use TimiTao\Construo\Domain\Model\Board\Repository as BoardRepository;
use TimiTao\Construo\Domain\Model\Board\ValueObject\Key;

class Repository implements BoardRepository
{
    /** @var array */
    private $list;

    public function __construct()
    {
        $this->clear();
    }

    public function clear(): void
    {
        $this->list = [];
    }

    public function addBoard(Board $board): void
    {
        $this->list[serialize($board->getKey()->getValue())] = $board;
    }

    public function findBoard(Key $key): ?Board
    {
        $serialize = serialize($key->getValue());
        if (!isset($this->list[$serialize])) {
            return null;
        }
        return $this->list[$serialize];
    }

    public function getList(): array
    {
        return $this->list;
    }
}
