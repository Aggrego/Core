<?php

/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Component\BoardComponent\Application\Board;

use Aggrego\Component\BoardComponent\Application\Board\Exception\BoardExist;
use Aggrego\Component\BoardComponent\Application\Board\Exception\BoardNotFound;
use Aggrego\Component\BoardComponent\Domain\Board\Board;
use Aggrego\Component\BoardComponent\Domain\Board\Id\Id;

interface BoardRepository
{
    /**
     * @throws BoardNotFound
     */
    public function getBoardByUuid(Id $id): Board;

    /**
     * @throws BoardExist
     */
    public function addBoard(Board $board): void;
}
