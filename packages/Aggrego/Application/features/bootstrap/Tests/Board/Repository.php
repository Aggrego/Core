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

namespace Tests\Board;

use Aggrego\Application\Board\Board;
use Aggrego\Application\Board\Exception\BoardNotFoundException;
use Aggrego\Application\Board\Repository as BoardRepository;
use Aggrego\Application\Board\Uuid;

class Repository implements BoardRepository
{
    /**
     * @var array|Board[]
     */
    private $list;

    public function __construct()
    {
        $this->clear();
    }

    public function addBoard(Board $board): void
    {
        $this->list[(string)$board->getId()->getValue()] = $board;
    }

    public function getBoardByUuid(Uuid $uuid): Board
    {
        foreach ($this->list as $board) {
            if ($uuid->equal($board->getId())) {
                return $board;
            }
        }
        throw new BoardNotFoundException(sprintf('Board not found with uuid: %s', $uuid->getValue()));
    }

    public function clear(): void
    {
        $this->list = [];
    }

    public function getList(): array
    {
        return $this->list;
    }
}
