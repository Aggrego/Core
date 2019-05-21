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

namespace Aggrego\Domain\Board;

use Aggrego\Domain\Board\Exception\BoardExistException;
use Aggrego\Domain\Board\Exception\BoardNotFoundException;

interface Repository
{
    /**
     * @param  Uuid $uuid
     * @return Board
     * @throws BoardNotFoundException
     */
    public function getBoardByUuid(Uuid $uuid): Board;

    /**
     * @param  Board $board
     * @throws BoardExistException
     */
    public function addBoard(Board $board): void;
}
