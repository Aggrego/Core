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

namespace Aggrego\Application\Profile\BoardConstruction;

use Aggrego\Application\Board\Key;
use Aggrego\Application\Board\Prototype\Board as BoardPrototype;
use Aggrego\Application\Profile\BoardConstruction\Exception\UnableToBuildBoardException;

interface Builder
{
    /**
     * @param  Key $key
     * @return BoardPrototype
     * @throws UnableToBuildBoardException
     */
    public function build(Key $key): BoardPrototype;
}
