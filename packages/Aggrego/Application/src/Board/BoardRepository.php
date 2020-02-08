<?php
/**
 * This file is part of the Aggrego.
 * (c) Tomasz Kunicki <kunicki.tomasz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Aggrego\Application\Board;

use Aggrego\Application\Board\Exception\BoardExist;
use Aggrego\Application\Board\Exception\BoardNotFound;
use Aggrego\Domain\Board\Board;
use Aggrego\Domain\Board\Id\Id;

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
